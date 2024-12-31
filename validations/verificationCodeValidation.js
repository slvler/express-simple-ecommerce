const Joi = require("joi");

const verifyCode = Joi.object({
  email: Joi.string()
    .min(6)
    .max(255)
    .required()
    .email({ tlds: { allow: ["com", "net"] } }),
  provided_code: Joi.string().min(6).max(255).required(),
});

const sendCode = Joi.object({
  email: Joi.string()
    .min(6)
    .max(255)
    .required()
    .email({ tlds: { allow: ["com", "net"] } }),
});

module.exports = {
  verifyCode,
  sendCode,
};
