const express = require("express");
const { signup, signin, sendVerificationCode, logout } = require('../controllers/authController.js');

const router = express.Router();

router.route("/signup").post(signup);
router.route("/signin").post(signin);
router.route("/send-verification-code").post(sendVerificationCode);
router.route("/logout").post(logout);

module.exports = router;