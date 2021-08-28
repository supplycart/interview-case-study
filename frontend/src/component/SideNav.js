import React, {useState} from 'react';
import {Link} from 'react-router-dom';

function SideNav(props){

    const [sidebar, setSidebar] = useState();

    // class name to toggle sidebar
    let menuActive ="sidebar bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative  transition duration-200 ease-in-out";
    let menu = "sidebar bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out";

    return(
        <div className="flex flex-col w-60 bg-gray-900">
            <div className="flex items-center justify-center ">
                <div className="flex items-center">
                    <span className="mb-4 mt-10 text-2xl font-semibold text-white">Supply Trolly</span>
                </div>
            </div>
            <hr className="my-4 md:min-w-full" />

            <nav className="md:flex-nowrap md:overflow-hidden flex flex-col px-4 mt-4 text-center">
                <Link to="/"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Home</Link>
                <Link href="/cart"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Cart</Link>
                <Link href="#"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Settings</Link>
                <Link href="/login"
                      className="py-2 mt-3 text-sm text-gray-400 rounded hover:text-gray-700  hover:bg-gray-200"
                >Logout</Link>
            </nav>
        </div>
    
    )

}

export default SideNav;