import React from 'react';
import {Link} from 'react-router-dom';

function SideNav(props){

    const [sidebar, setSidebar] = props.functions;

    // class name to toggle sidebar
    let menuActive ="sidebar bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative  transition duration-200 ease-in-out";
    let menu = "sidebar bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out";

    return(
        <div className="relative min-w-screen min-h-screen md:flex">

            {/* side bar */}
            <div className={sidebar ? menuActive : menu}>
                {/* logo and home btn */}
                <Link to="#" className="text-white flex items-center space-x-2 px-4">
                    <svg className="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <span className="text-2xl font-extrabold">Better Dev</span>
                </Link>

                {/* nav */}
                <nav>
                    <Link 
                        to="Cart" 
                        className="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white"
                    >Home</Link>

                    <Link 
                        to="Cart" 
                        className="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white"
                    >Cart</Link>
                    
                    <Link 
                        to="History" 
                        className="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white"
                    >History</Link>
                    
                    <Link
                        to="Logout" 
                        className="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white"
                    >Logout</Link>
                </nav>
            </div>

            <div className="flex-1 p-10 text-2xl font-bold">
                content goes here
            </div>

        </div>
    
    )

}

export default SideNav;