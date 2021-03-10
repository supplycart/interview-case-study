require('dotenv').config;

const express = require('express');
const ejs = require('ejs');
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

// =============================================================================
// GLOBAL VARIABLE
// =============================================================================

var users = [
    {name: "admin", password: "admin"}
]

var products = [
    {id: 1, name: "Transforming chair", price: "RM450.00", cart:false},
    {id: 2, name: "Bottle", price: "RM10.00", cart:false},
    {id: 3, name: "Used cap", price: "RM0.10", cart:false},
    {id: 4, name: "Broken TV", price: "RM20.00", cart:false},

]

var cart = []

var bought = [
    {user: 'admin', items: []}
]

var tried = 0
var exist = 0
var diffPass = 0
var success = 0

// =============================================================================
// GET requests
// =============================================================================

app.get('/', checkNotAuthenticated, function(req, res) {

    let obj = {
        tried: tried,
    }

    success = 0

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
        products: products
    }
    res.render("homepage", obj)
})

app.get('/cart', checkAuthenticated, function(req, res) {

    let obj = {
        carts: cart
    }

    res.render("cart", obj)
})

app.get('/checkout', checkAuthenticated, function(req, res) {

    res.render("checkout")

})

app.get('/history', checkAuthenticated, function(req, res) {

    const history = userBoughtItems(req.user.name)

    let obj = {
        history: history
    }

    res.render('history', obj)
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
        bought.push({
            user: givenCredentials.name,
            items: []
        })
        success = 1
        res.redirect(`/register`)
    }
})

app.post('/logout', function(req, res) {

    cart = []
    products.forEach( product => product.cart = false )

    req.logOut()
    res.redirect('/')
})

app.post('/addToCart', function(req, res) {

    const givenId = req.body.id
    const product = haveProduct(givenId)

    if (product) {
        products[product.id-1].cart = true
        cart.push(product)
    }

    res.redirect("/homepage")
})

app.post('/removeFromCart', function(req, res) {

    const givenId = req.body.id
    const product = haveProduct(givenId)

    if (product) {
        products[product.id-1].cart = false
        let idx = cart.indexOf(product)
        cart.splice(idx, 1)
    }

    res.redirect("/cart")
})

app.post('/checkout', function(req, res) {

    checkout = []

    cart.forEach( items => {
        checkout.push(items)
    })

    products.forEach( product => product.cart = false )

    bought.forEach( data => {
        if (data.user == req.user.name) {
            data.items = data.items.concat(checkout)
        }
    })

    cart = []

    res.redirect('/checkout')
})

// =============================================================================
// Others
// =============================================================================

app.listen(process.env.PORT || 3000, function () {
    console.log("Server started")
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

// To check if the chosen product is already in cart
function haveProduct(productId) {

    let found = false

    products.forEach( product => {
        if (product.id == productId) {
            found = product
            return
        }
    })

    return found

}

// To find the items bought by a certain user
function userBoughtItems(user) {

    let found = false

    bought.forEach( data => {
        if (data.user == user) {
            found = data.items
            return
        }
    })

    return found

}