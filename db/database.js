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
        try {
            console.log("DB Connecting...");
            let db = await mongoose.connect(options.CONNECTION_STRING);

            this.connection = db
            console.log("MongoDB Connected")
        } catch (err) {
            console.error(err);
            process.exit(1);
        }

    }
}

module.exports = Database;