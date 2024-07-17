const express = require('express');
const bodyParser = require('body-parser');
const sql = require('mssql');

const app = express();

// Middleware
app.use(bodyParser.urlencoded({ extended: false }));

// Database connection string
const config = {
    user: 'sa',
    password: 'abewin3451',
    server: 'LAPTOP-NV52G4EE\\SQLEXPRESS', 
    database: 'master',
};

// Login endpoint
app.post('/login', async (req, res) => {
    try {
        let pool = await sql.connect(config);
        const { email, password } = req.body; // Assuming you named the form inputs 'email' and 'password'

        // You should hash the password and compare it against the hashed version stored in the DB
        let result = await pool.request()
            .input('email', sql.NVarChar, email)
            .input('password', sql.NVarChar, password)
            .query('SELECT * FROM users WHERE email_address = @email AND password = @password');

        if (result.recordset.length > 0) {
            res.send('Logged in successfully!');
        } else {
            res.send('Invalid credentials.');
        }

        pool.close();
    } catch (err) {
        console.error(err);
        res.status(500).send('Server error');
    }
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
