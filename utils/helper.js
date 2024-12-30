const bcrypt = require("bcrypt")

const doHash = async (value, saltValue) => {
    const salt = await bcrypt.genSalt(saltValue);
    const hash = await bcrypt.hash(value, salt);
    return hash;
}

module.exports = {
    doHash
}
