const Joi = require("joi");

const changePasswordValidation = Joi.object({
  old_password: Joi.string().min(6).max(255).required(),
  new_password: Joi.string().min(6).max(255).required(),
});

module.exports = {
  changePasswordValidation,
};
