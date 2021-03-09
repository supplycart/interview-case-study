const LocalStrategy = require('passport-local').Strategy

function initialize(passport, getUserByEmail) {
    const authenticateUser = async (name, password, done) => {
      const user = getUserByEmail(name)
      if (user == null) {
        return done(null, false, { message: 'NO USER FOUND' })
      }
  
      try {
        if (password == user.password) {
          return done(null, user)
        } else {
          return done(null, false, { message: 'WRONG PASSWORD' })
        }
      } catch (e) {
        return done(e)
      }
    }
  
    passport.use(new LocalStrategy({ usernameField: 'name' }, authenticateUser))
    passport.serializeUser((user, done) => done(null, user.name))
    passport.deserializeUser((name, done) => {
      return done(null, getUserByEmail(name))
    })
  }
  
  module.exports = initialize