import React from "react";
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';

// import HTML pages
import Register from './component/registration';
import Login from './component/login';
import Home from './component/home';

function App(){
  return(
    <Router>
      <Switch>
        <Route exact path='/' component={Home} />
        <Route exact path='/login' component={Login} />
        <Route exact path='login' component={Register} />

      </Switch>
    </Router>

  )

}

export default App;
