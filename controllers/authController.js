const { registerValidation } = require("../validations/registerValidation.js");
const { loginValidation } = require("../validations/loginValidation.js");
const User = require("../models/User.js");
const { doHash, checkPassword, hmacProcess } = require("../utils/helper.js");
const {
  SALT,
  JWT_SECRET,
  NODE_ENV,
  MAIL_SENDING_ADDRESS,
  HMAC_VERIFICATION_CODE_SECRET,
} = require("../config/config.js");
const jwt = require("jsonwebtoken");
const transform = require("../utils/sendMail.js");
const {
  verifyCode,
  sendCode,
} = require("../validations/verificationCodeValidation.js");
const {
  changePasswordValidation,
} = require("../validations/changePasswordValidation.js");
const {
  verifyChangePasswordValidation,
} = require("../validations/verifyChangePasswordValidation.js");

const signup = async (req, res) => {
  try {
    const { error, value } = registerValidation.validate(req.body);
    if (error) {
      return res.status(401).json({
        success: false,
        message: error.details[0].message,
      });
    }
    const exists = await User.findOne({ email: req.body.email });
    if (exists) {
      return res.status(401).json({
        success: false,
        message: "user already exists!",
      });
    }
    const hashPassword = await doHash(req.body.password, SALT);

    const newUser = new User({
      email: req.body.email,
      password: hashPassword,
      first_name: "john",
      last_name: "doe",
      phone: "555 666 777",
    });

    const result = await newUser.save();

    if (result) {
      result.password = undefined;

      return res.status(201).json({
        success: true,
        message: "register was successful",
        result: result,
      });
    } else {
      return res.status(400).json({
        status: true,
        message: "user register fail",
      });
    }
  } catch (error) {
    return res.json({
      status: false,
      message: error.message,
    });
  }
};

const signin = async (req, res) => {
  try {
    const { error, value } = loginValidation.validate(req.body);
    if (error) {
      return res.status(401).json({
        success: false,
        message: error.details[0].message,
      });
    }
    let existsUser = await User.findOne({ email: req.body.email }).select(
      "+password",
    );
    if (!existsUser) {
      return res.status(401).json({
        success: false,
        message: "Invalid Email or Password",
      });
    }
    let passwordCheck = await checkPassword(
      req.body.password,
      existsUser.password,
    );
    if (!passwordCheck) {
      return res.status(401).json({
        success: false,
        message: "Invalid Email or Password",
      });
    }

    const token = jwt.sign(
      {
        _id: existsUser._id,
        email: existsUser.email,
        verified: existsUser.verified,
        name: existsUser.name,
      },
      JWT_SECRET,
      {
        expiresIn: "8h",
      },
    );

    res
      .status(200)
      .cookie("Authorization", "Bearer " + token, {
        expires: new Date(Date.now() + 8 * 3600000),
        httpOnly: NODE_ENV === "production",
        secure: NODE_ENV === "production",
      })
      .json({
        success: true,
        token,
        message: "logged in successfully",
      });
  } catch (error) {
    return res.status(500).json({
      success: false,
      message: error,
    });
  }
};

const logout = async (req, res) => {
  res
    .clearCookie("Authorization")
    .status(200)
    .json({ success: true, message: "logged out successfully" });
};

const sendVerificationCode = async (req, res) => {
  try {
    const user = await User.findOne({
      email: req.body.email,
    });

    if (!user) {
      return res.status(401).json({
        success: false,
        message: "Invalid Email or Password",
      });
    }

    if (user.verified) {
      return res
        .status(400)
        .json({ success: false, message: "You are already verified!" });
    }

    const code_value = Math.floor(Math.random() * 1000000).toString();

    let info = await transform.sendMail({
      from: MAIL_SENDING_ADDRESS,
      to: user.email,
      subject: "verification code",
      html: "<h1>" + code_value + "</h1>",
    });

    if (info.accepted[0] === user.email) {
      const hashed_code_value = await hmacProcess(
        code_value,
        HMAC_VERIFICATION_CODE_SECRET,
      );

      user.verification_code = hashed_code_value;
      user.verification_code_validation = Date.now();
      await user.save();
      return res.status(200).json({ success: true, message: "Code sent!" });
    }
    res.status(400).json({ success: false, message: "Code sent failed!" });
  } catch (error) {
    return res.status(500).json({
      success: false,
      message: error,
    });
  }
};

const verifyVerificationCode = async (req, res) => {
  const { email, provided_code } = req.body;

  const { error, value } = verifyCode.validate({ email, provided_code });

  if (error) {
    return res.status(401).json({
      success: false,
      message: error.details[0].message,
    });
  }
  const code_value = provided_code.toString();
  let existUser = await User.findOne({ email: email }).select(
    "+verification_code +verification_code_validation",
  );

  if (!existUser) {
    return res.status(401).json({
      success: false,
      message: "Invalid Email or Password",
    });
  }

  if (!existUser.verification_code || !existUser.verification_code_validation) {
    return res.status(400).json({
      success: false,
      message: "Something is wrong with the code!",
    });
  }

  if (Date.now - existUser.verification_code_validation > 5 * 60 * 1000) {
    return res.status(400).json({
      success: false,
      message: "code has been expired!",
    });
  }

  const hashed_code_value = await hmacProcess(
    code_value,
    process.env.HMAC_VERIFICATION_CODE_SECRET,
  );

  if (hashed_code_value === existUser.verification_code) {
    existUser.verified = true;
    existUser.verification_code = undefined;
    existUser.verification_code_validation = undefined;
    await existUser.save();
    return res
      .status(200)
      .json({ success: true, message: "your account has been verified!" });
  }
  return res
    .status(400)
    .json({ success: false, message: "unexpected occured!!" });
};

const changePassword = async (req, res) => {
  try {
    const { _id, verified } = req.user;
    const { old_password, new_password } = req.body;

    const { error, value } = changePasswordValidation.validate({
      old_password,
      new_password,
    });

    if (error) {
      return res.status(401).json({
        success: false,
        message: error.details[0].message,
      });
    }

    if (!verified) {
      return res
        .status(401)
        .json({ success: false, message: "You are not verified user!" });
    }

    const existing_user = await User.findOne({ _id: _id }).select("+password");

    if (!existing_user) {
      return res
        .status(401)
        .json({ success: false, message: "User does not exists!" });
    }

    const result = await checkPassword(old_password, existing_user.password);

    if (!result) {
      return res
        .status(401)
        .json({ success: false, message: "Invalid credentials!" });
    }

    const hashed_password = await doHash(new_password, SALT);
    existing_user.password = hashed_password;
    await existing_user.save();

    return res
      .status(200)
      .json({ success: true, message: "Password updated!!" });
  } catch (error) {
    return res.json({
      status: false,
      message: error.message,
    });
  }
};

const sendForgotPasswordCode = async (req, res) => {
  const { email } = req.body;

  const exists_user = await User.findOne({ email: email });

  if (!exists_user) {
    return res
      .status(404)
      .json({ success: false, message: "User does not exists!" });
  }

  const code_value = Math.floor(Math.random() * 1000000).toString();

  let info = await transform.sendMail({
    from: MAIL_SENDING_ADDRESS,
    to: exists_user.email,
    subject: "verification code",
    html: "<h1>" + code_value + "</h1>",
  });

  if (info.accepted[0] === exists_user.email) {
    const hashed_code_value = await hmacProcess(
      code_value,
      HMAC_VERIFICATION_CODE_SECRET,
    );
    exists_user.forgot_password_code = hashed_code_value;
    exists_user.forgot_password_code_validation = Date.now();
    await exists_user.save();
    return res.status(200).json({ success: true, message: "Code sent!" });
  }
  res.status(400).json({ success: false, message: "Code sent failed!" });
};
const verifyForgotPasswordCode = async (req, res) => {
  const { email, provided_code, new_password } = req.body;

  const { error, value } = verifyChangePasswordValidation.validate({
    email,
    provided_code,
    new_password,
  });
  if (error) {
    return res.status(401).json({
      success: false,
      message: error.details[0].message,
    });
  }

  const code_value = provided_code.toString();

  const existing_user = await User.findOne({ email: email }).select(
    "+forgot_password_code +forgot_password_code_validation",
  );

  if (!existing_user) {
    return res
      .status(401)
      .json({ success: false, message: "User does not exists!" });
  }

  if (
    !existing_user.forgot_password_code ||
    !existing_user.forgot_password_code_validation
  ) {
    return res
      .status(400)
      .json({ success: false, message: "something is wrong with the code!" });
  }

  if (
    Date.now() - existing_user.forgot_password_code_validation >
    5 * 60 * 1000
  ) {
    return res
      .status(400)
      .json({ success: false, message: "code has been expired!" });
  }

  const hashed_code_value = await hmacProcess(
    code_value,
    HMAC_VERIFICATION_CODE_SECRET,
  );

  if (hashed_code_value === existing_user.forgot_password_code) {
    const hashed_password = await doHash(new_password, SALT);
    existing_user.password = hashed_password;
    existing_user.forgotPasswordCode = undefined;
    existing_user.forgotPasswordCodeValidation = undefined;
    await existing_user.save();
    return res
      .status(200)
      .json({ success: true, message: "Password updated!!" });
  }
  return res
    .status(400)
    .json({ success: false, message: "unexpected occured!!" });
};

module.exports = {
  signup,
  signin,
  sendVerificationCode,
  verifyVerificationCode,
  changePassword,
  sendForgotPasswordCode,
  verifyForgotPasswordCode,
  logout,
};
