const mongoose = require('mongoose');

let instance = null;
class Database {
    constructor() {
        if (!instance)
        {
            this.connection = null;
            instance = this;
        }
        return instance;
    }

    async connect(options) {
        let db = await mongoose.connect(options.CONNECTION_STRING);
        this.connection = db
    }
}

module.exports = Database;