require('dotenv').config;

const express = require('express');
const bodyParser = require('body-parser');
const ejs = require('ejs');

const app = express();

app.set('view engine', 'ejs')

app.use(bodyParser.urlencoded({extended: false}))

app.use(express.static(__dirname + "/public"))

app.use("/public", express.static('public'))

app.get('/', function(req, res) {
    res.render("log-in")
})

app.listen(3000, function () {
    console.log("Server started on port 3000")
})