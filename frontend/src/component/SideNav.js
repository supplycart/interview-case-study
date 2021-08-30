import React from 'react';
import {Link, useHistory} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert';

function SideNav(){

    let history = useHistory();

    // method to logout
    const logout = (e) => {
        e.preventDefault();

        axios.post(`/api/logout`)
            .then(()=> {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('auth_name');
                swal("Success", 'Please come again', 'success');
                history.push('/login');
            })
            .catch((e)=>{
                console.log(e);
            });
    }

    // if user is not login show login and register button
    let btn;
    if(!localStorage.getItem('auth_token')){
        btn = (
            <Link
                to="/login"
              className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
            >Login</Link>
        );

    } else { // show logout button
        btn = (
            <button
                onClick={logout}
                className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
            >Logout</button>
        );
    }

    return(
        <div className="flex flex-col w-60 bg-gray-900">
            <div className="flex items-center justify-center ">
                <div className="flex items-center">
                    <span className="mb-4 mt-10 text-2xl font-semibold text-white">Supply Trolly</span>
                </div>
            </div>
            <hr className="my-4 md:min-w-full" />

            <nav className="md:flex-nowrap md:overflow-hidden flex flex-col px-4 mt-4 text-center">
                <Link to="/home"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Home</Link>
                <Link to="/cart"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Cart</Link>
                <Link to="/order-history"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Order History</Link>
                <Link
                    to="/register"
                    className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Register New Account</Link>
                {btn}
            </nav>
        </div>
    
    )

}

export default SideNav;