const express = require("express");
const database = require('./db/database.js')
const { CONNECTION_STRING, PORT } = require('./config/config.js')


//router
const auth = require('./routes/authRouter.js')
const categories = require('./routes/categories.js')
const users = require('./routes/users.js')
const roles = require('./routes/roles.js')

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use('/api/auth', auth);
app.use('/api/users', users);
app.use('/api/categories', categories);
app.use('/api/roles', roles);



new database().connect({CONNECTION_STRING})




app.listen(PORT, () => {
    console.log(`Server listen at port ${PORT}`);
});