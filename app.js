require('dotenv').config;

const express = require('express');
const ejs = require('ejs');
const _ = require('lodash');
const passport = require('passport')
const flash = require('express-flash')
const session = require('express-session')

const initializePassport = require('./passport-config')
initializePassport(
    passport, 
    name => users.find(user => user.name == name)
);

const app = express();

app.set('view engine', 'ejs')
app.use(express.urlencoded({extended: false}))
app.use(flash())

app.use(session({
    secret: "SECRET",
    resave: false,
    saveUninitialized: false
}))
app.use(passport.initialize())
app.use(passport.session())

app.use(express.static(__dirname + "/public"))
app.use("/public", express.static('public'))

// GLOBAL VARIABLE

var users = [
    {name: "admin", password: "admin"}
]
var tried = 0
var exist = 0
var diffPass = 0
var success = 0

// GET requests
app.get('/', checkNotAuthenticated, function(req, res) {

    let obj = {
        tried: tried,
        success: success
    }

    res.render("log-in", obj)
})

app.get('/register', checkNotAuthenticated,  function(req, res) {

    let obj = {
        diffPass: diffPass,
        exist: exist,
        success: success
    }

    res.render("register", obj)
})

app.get('/homepage', checkAuthenticated, function(req, res) {

    let obj = {
        username: `${req.user.name}`,
    }
    res.render("homepage", obj)
})

// =============================================================================
// POST requests
// =============================================================================

app.post('/log-in', passport.authenticate('local', {
    successRedirect: `/homepage`,
    failureRedirect: `/`,
    failureFlash: true

})) 

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
    } else if (success) {
        res.redirect('/')
    } else {
        diffPass = 0
        exist = 0
        users.push(givenCredentials)
        success = 1
        res.redirect(`/register`)
    }
})

app.post('/logout', function(req, res) {
    req.logOut()
    res.redirect('/')
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

function checkAuthenticated(req, res, next) {
    if (req.isAuthenticated()) {
        return next()
    }

    res.redirect('/')
}

function checkNotAuthenticated(req, res, next) {
    if (req.isAuthenticated()) {
        return res.redirect(`/homepage`)
    }

    next()
}