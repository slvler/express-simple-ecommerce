const Joi = require("joi")

const loginValidation = Joi.object({
    email: Joi.string().min(6).max(255).required().email({ tlds: { allow: ['com', 'net'] } }),
    password: Joi.string().min(6).max(255).required(),
});

module.exports = {
    loginValidation
}