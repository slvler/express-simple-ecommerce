const express = require("express");
const router = express.Router();
const {index, create, update} = require('../controllers/roleController.js');

router.route("/").get(index);
router.route("/").post(create);
router.route("/:id").put(update);

module.exports = router;
