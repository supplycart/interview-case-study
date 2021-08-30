import React from "react";
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import axios from 'axios';

// import HTML pages
import Register from './component/registration';
import Login from './component/login';
import Home from './component/home';
import Cart from './component/Cart';
import ItemDetail from './component/ItemDetail';
import OrderHistory from "./component/OrderHistory";

// default headers for API call
axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers['Content-Type'] = 'application/json';
axios.defaults.headers['Access-Control-Allow-Origin'] = "*";
axios.defaults.headers['Accept'] = 'application/json';
axios.defaults.withCredentials = true;
axios.interceptors.request.use(function (config){  // set the API token
    const token = localStorage.getItem('auth_token');
    config.headers.Authorization = token ? `Bearer ${token}`: ''; // if no token found in headers, set it
    return config;
})

function App(){
  return(
    <div>
      <Router>
        <Switch>
            <Route exact path='/home' component={Home} />
            <Route exact path='/order-history' component={OrderHistory}/>
            <Route exact path='/login' component={Login} />
            <Route exact path='/register' component={Register} />
            <Route exact path='/cart' component={Cart} />
            <Route path='/product/:id' component={ItemDetail} />
        </Switch>
      </Router>
    </div>

  )

}

export default App;
