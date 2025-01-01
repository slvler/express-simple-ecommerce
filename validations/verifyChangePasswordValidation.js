const Joi = require("joi");

const verifyChangePasswordValidation = Joi.object({
  email: Joi.string()
    .min(6)
    .max(60)
    .required()
    .email({
      tlds: { allow: ["com", "net"] },
    }),
  provided_code: Joi.string().min(6).max(255).required(),
  new_password: Joi.string().min(6).max(255).required(),
});

module.exports = {
  verifyChangePasswordValidation,
};
