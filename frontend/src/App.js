import React from "react";
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import axios from 'axios';

// import HTML pages
import Register from './component/registration';
import Login from './component/login';
import Home from './component/home';
import Cart from './component/Cart';
import ItemDetail from './component/ItemDetail';

// default headers for API call
axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers = {"Access-Control-Allow-Origin": "*"};
axios.defaults.headers['Content-Type'] = 'application/json';
axios.defaults.headers['Accept'] = 'application/json';

function App(){
  return(
    <div>
      <Router>
        <Switch>
            <Route exact path='/' component={Home} />
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
