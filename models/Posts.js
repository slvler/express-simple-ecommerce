const mongoose = require("mongoose")

const schema = mongoose.Schema({
    title: { type: String, required: true, trim: true },
    description: { type: String, required: true, trim: true },
    userId:{ type: mongoose.Schema.Types.ObjectId, ref: "users", required: true },
},{
    timestamps:{
        createdAt: "created_at",
        updatedAt: "updated_at"
    },
});

module.exports= mongoose.model("posts", schema)