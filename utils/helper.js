const bcrypt = require("bcrypt");
const { createHmac } = require('crypto');

const doHash = async (value, saltValue) => {
    const salt = await bcrypt.genSalt(saltValue);
    const hash = await bcrypt.hash(value, salt);
    return hash;
}
const checkPassword = async (password, check) => {
    const hash = await bcrypt.compare(password, check);
    return hash;
}

const hmacProcess = async(value, key) => {
    const result = createHmac('sha256', key).update(value).digest('hex');
    return result;
}

module.exports = {
    doHash,
    checkPassword,
    hmacProcess
}
