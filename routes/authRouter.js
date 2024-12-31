const express = require("express");
const {
  signup,
  signin,
  sendVerificationCode,
  verifyVerificationCode,
  changePassword,
  logout,
} = require("../controllers/authController.js");
const isAuth = require("../middlewares/isAuth.js");

const router = express.Router();

router.route("/signup").post(signup);
router.route("/signin").post(signin);
router.route("/send-verification-code").post(sendVerificationCode);
router.route("/verify-verification-code").post(verifyVerificationCode);
router.route("/change-password").post(isAuth, changePassword);
router.route("/logout").post(logout);

module.exports = router;
