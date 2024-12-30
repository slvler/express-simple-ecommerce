const dotenv = require("dotenv")

dotenv.config()

module.exports = {
    "NODE_ENV": process.env.NODE_ENV,
    "PORT": 3000,
    "CONNECTION_STRING": process.env.CONNECTION_STRING,
    //MONGO_IP: process.env.MONGO_IP || "mongo",
    //MONGO_PORT: process.env.MONGO_PORT || 27017,
    //MONGO_USER: process.env.MONGO_USER,
    //MONGO_PASSWORD: process.env.MONGO_PASSWORD,
    "JWT_SECRET": process.env.TOKEN_SECRET,
    "SALT": parseInt(process.env.SALT),

    "MAIL_HOST": process.env.MAIL_HOST,
    "MAIL_PORT": process.env.MAIL_PORT,
    "MAIL_USER": process.env.MAIL_USER,
    "MAIL_PASSWORD": process.env.MAIL_PASSWORD,
    "MAIL_SENDING_ADDRESS" : process.env.MAIL_SENDING_ADDRESS,

    "HMAC_VERIFICATION_CODE_SECRET": process.env.HMAC_VERIFICATION_CODE_SECRET
}
