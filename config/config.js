const dotenv = require("dotenv")

dotenv.config()

module.exports = {
    "PORT": 3000,
    "CONNECTION_STRING": process.env.CONNECTION_STRING,
    //MONGO_IP: process.env.MONGO_IP || "mongo",
    //MONGO_PORT: process.env.MONGO_PORT || 27017,
    //MONGO_USER: process.env.MONGO_USER,
    //MONGO_PASSWORD: process.env.MONGO_PASSWORD,
    "JWT_SECRET": process.env.TOKEN_SECRET,
    "SALT": parseInt(process.env.SALT),
}