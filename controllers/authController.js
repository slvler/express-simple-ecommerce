const { registerValidation } = require("../validations/registerValidation.js");
const { loginValidation } = require("../validations/loginValidation.js");
const User = require("../models/User.js");
const { doHash, checkPassword, hmacProcess } = require("../utils/helper.js");
const { SALT, JWT_SECRET, NODE_ENV, MAIL_SENDING_ADDRESS, HMAC_VERIFICATION_CODE_SECRET } = require("../config/config.js");
const jwt = require('jsonwebtoken');
const transform = require('../utils/sendMail.js');

const signup = async (req, res) => {

    try{
        const {error, value} = registerValidation.validate(req.body);
        if (error){
            return res.status(401).json({
                success: false,
                message: error.details[0].message
            });
        }
        const exists = await User.findOne({ email: req.body.email });
        if (exists){
            return res.status(401).json({
                success: false,
                message: "user already exists!"
            });
        }
        const hashPassword = await doHash(req.body.password, SALT);
        const newUser= new User({
            email: req.body.email,
            password: hashPassword,
            first_name: "john",
            last_name: "doe",
            phone: "555 666 777",
        });

        const result = await newUser.save();
        result.password = undefined;

        return res.status(200).json({
            success: true,
            message: "register was successful",
            result: result
        });
    }catch (error) {
        return res.status(500).json({
            success: false,
            message: error
        });
    }
}

const signin = async (req, res) => {

    try{
        const { error, value} = loginValidation.validate(req.body);
        if (error){
            return res.status(401).json({
                success: false,
                message: error.details[0].message
            });
        }
        let existsUser = await User.findOne({email: req.body.email}).select("+password");
        if (!existsUser){
            return res.status(401).json({
                success: false,
                message: 'Invalid Email or Password',
            });
        }
        let passwordCheck = await checkPassword(req.body.password, existsUser.password)
        if (!passwordCheck){
            return res.status(401).json({
                success: false,
                message: 'Invalid Email or Password',
            });
        }
        const token = jwt.sign(
            {
                userId: existsUser._id,
                email: existsUser.email,
                verified: existsUser.verified,
            },
            JWT_SECRET,
            {
                expiresIn: '8h',
            }
        );

        res
            .status(200)
            .cookie('Authorization', 'Bearer ' + token, {
                expires: new Date(Date.now() + 8 * 3600000),
                httpOnly: NODE_ENV === 'production',
                secure: NODE_ENV === 'production',
            })
            .json({
                success: true,
                token,
                message: 'logged in successfully',
            });
    }catch (error) {
        return res.status(500).json({
            success: false,
            message: error
        });
    }
}

const logout = async (req, res) => {
    res
        .clearCookie('Authorization')
        .status(200)
        .json({ success: true, message: 'logged out successfully' });
}

const sendVerificationCode = async(req, res) => {
    try{
        const user = await User.findOne({
            email: req.body.email
        });

        if (!user){
            return res.status(401).json({
                success: false,
                message: 'Invalid Email or Password',
            });
        };

        if (user.verified) {
            return res
                .status(400)
                .json({ success: false, message: 'You are already verified!' });
        }

        const codeValue = Math.floor(Math.random() * 1000000).toString();


        let info = await transform.sendMail({
            from: MAIL_SENDING_ADDRESS,
            to: user.email,
            subject: 'verification code',
            html: '<h1>' + codeValue + '</h1>',
        });

        if (info.accepted[0] === user.email) {
            const hashedCodeValue = hmacProcess(
                codeValue,
                HMAC_VERIFICATION_CODE_SECRET
            );
            user.verification_code = hashedCodeValue;
            user.verification_code_validation = Date.now();
            await user.save();
            return res.status(200).json({ success: true, message: 'Code sent!' });
        }
        res.status(400).json({ success: false, message: 'Code sent failed!' });
    }catch (error){
        return res.status(500).json({
            success: false,
            message: error
        });
    }
}

module.exports = {
    signup,
    signin,
    sendVerificationCode,
    logout
}