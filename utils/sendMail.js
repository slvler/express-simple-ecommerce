const nodemailer = require('nodemailer');
const { MAIL_HOST, MAIL_PORT, MAIL_USER, MAIL_PASSWORD } = require('../config/config.js')

const transport = nodemailer.createTransport({
    host: MAIL_HOST,
    port: MAIL_PORT,
    auth: {
        user: MAIL_USER,
        pass: MAIL_PASSWORD
    }
});


module.exports = transport;