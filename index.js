const express = require('express')
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '111111',
  database : 'blog'
});


const app = express()
const port = 3000
// set the view engine to ejs
app.set('view engine', 'ejs');
// use res.render to load up an ejs view file


app.get('/', (req, res) => {
    connection.connect();

    connection.query('SELECT * from posts', function (error, results, fields) {
        if (error) throw error;
        
        res.render('homepage', {
            posts: results
        });
    });

    connection.end();
});

app.listen(port, () => console.log(`Example app listening at http://localhost:${port}`))