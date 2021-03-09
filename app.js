require('dotenv').config;

const express = require('express');
const bodyParser = require('body-parser');
const ejs = require('ejs');
const _ = require('lodash');
const { forEach } = require('lodash');

const app = express();

app.set('view engine', 'ejs')

app.use(bodyParser.urlencoded({extended: false}))

app.use(express.static(__dirname + "/public"))

app.use("/public", express.static('public'))

// GLOBAL VARIABLE

var users = [
    {name: "admin", password: "admin"}
]
var tried = 0
var exist = 0
var diffPass = 0

// GET requests
app.get('/', function(req, res) {

    let obj = {
        tried: tried,
    }

    res.render("log-in", obj)
})

app.get('/register', function(req, res) {

    let obj = {
        diffPass: diffPass,
        exist: exist
    }

    res.render("register", obj)
})

app.get('/homepage/:username', function(req, res) {

    let obj = {
        username: `${req.params.username}`,
    }
    res.render("homepage", obj)
})

// POST requests
app.post('/log-in', function(req, res) {

    const givenCredentials = {
        name: req.body.name,
        password: req.body.password
    }

    if (checkUser(givenCredentials)) {
        tried = 0
        res.redirect(`/homepage/${givenCredentials.name}`);
    } else {
        tried = 1
        res.redirect('/')
    }
})

app.post('/register', function(req, res) {

    const givenName = req.body.name
    const givenPass = req.body.password
    const retype = req.body.retypePassword

    const givenCredentials = {
        name: req.body.name,
        password: req.body.password
    }

    if (checkUserExist(givenCredentials)) {
        exist = 1
        diffPass = 0
        res.redirect('/register') 
    } else if (givenPass != retype) {
        diffPass = 1
        exist = 0
        res.redirect('/register')
    } else {
        diffPass = 0
        exist = 0

        users.push(givenCredentials)
        console.log(users)
        res.redirect(`homepage/${givenName}`)
    }
})

app.listen(3000, function () {
    console.log("Server started on port 3000")
})

// Function to check if correct user and password
function checkUser(userCredentials) {
    const name = userCredentials.name
    const password = userCredentials.password
    let found = false

    users.forEach( user => {
        if (user.name == name && user.password == password) {
            found = true
            return
        }
    })

    return found
}

// Function to check if user exists
function checkUserExist(userCredentials) {
    const name = userCredentials.name
    let found = false

    users.forEach( user => {
        if (user.name == name) {
            found = true
            return
        }
    })

    return found
}