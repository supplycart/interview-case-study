# interview-case-study

## Description

The project have been already deployment in to a server, you access through this [link](interview-case-study.vercel.app).

I have created this project using Vue.js & Tailwind, and consuming api from Laravel.

## Tasks

- [x] As guest, I want to be able to register an account
- [x] As guest, I want to be able to login using registered account
- [x] As user, I want to see list of products after login
- [x] As user, I want to be able to add product to cart
- [x] As user, I want to be able to place order for added products in cart
- [x] As user, I want to see my order history
- [x] As user, I want to be able to logout

## Bonus Tasks

- [ ] Verify email after registration
- [ ] User activity log e.g. login, logout, add to cart, place order etc
- [ ] Product attributes and filtering e.g brand, category
- [ ] Different user can see different price for products
- [ ] Add unit tests
- [x] Deploy app to a server

## Notes

- Before installing this project and running locally, you must have install the [backend repo](https://github.com/rezuankassim/interview-case-study-backend) too as this project is consuming api from [backend repo](https://github.com/rezuankassim/interview-case-study-backend)

## Project setup

```
yarn install
```

### Create environment variables

Create a `.env` file in your root file and create `VUE_APP_BASE_URL`

```
VUE_APP_BASE_URL=//interview-case-study-backend.test/api
```

### Compiles and hot-reloads for development

```
yarn serve
```

### Compiles and minifies for production

```
yarn build
```

### Lints and fixes files

```
yarn lint
```

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).
