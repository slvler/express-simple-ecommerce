const { signupSchema } = require("../validations/registerValidation.js")
const User = require("../models/User.js")
const { doHash } = require("../utils/helper.js")
const { SALT } = require("../config/config.js")

const signup = async (req, res) => {
    const {error, value} = signupSchema.validate(req.body);

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
}

const signin = (req, res) => {
    return res.json({
        status: true
    })
}

module.exports = {
    signup,
    signin
}