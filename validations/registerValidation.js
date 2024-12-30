const Joi = require("joi")

const registerValidation = Joi.object({
    name: Joi.string().min(3).max(18).required().messages({
        "string.base": `Username should be a type of 'text'.`,
        "string.empty": `Username cannot be an empty field.`,
        "string.min": `Username should have a minimum length of 3.`,
        "any.required": `Username is a required field.`,
    }),
    surname: Joi.string().min(3).max(18).empty(),
    email: Joi.string().min(6).max(255).required().email({ tlds: { allow: ['com', 'net'] } }),
    password: Joi.string().min(6).max(255).required(),
});

module.exports = {
    registerValidation
}