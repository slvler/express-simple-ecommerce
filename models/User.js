const mongoose = require("mongoose")

const schema = mongoose.Schema({
    email: { type: String, required: true },
    password: { type: String, required: true, trim: true, select:false },
    first_name: String,
    last_name: String,
    phone: String,
    verified: { type: Boolean, default: false },
    verification_code: { type: String, select: false },
    forgot_password_code: { type: String, select: false },
    forgot_password_code_validation: { type: Number, select: false },
},{
        timestamps:{
            createdAt: "created_at",
            updatedAt: "updated_at"
        },
});

const User = mongoose.model("User", schema);
module.exports = User;