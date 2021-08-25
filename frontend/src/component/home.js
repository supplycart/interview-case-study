import React, { useState } from 'react';
import SideBar from './SideNav';
import NavBar from './NavBar';

function Home() {
    const[sidebar, setSidebar] = useState(false); //control opening and closing of sidebar

    return(
        <div className='bg-gray-100'>
            <NavBar functions={[sidebar, setSidebar]} />
            <SideBar functions={[sidebar, setSidebar]} />
        </div>
        );
}

export default Home;