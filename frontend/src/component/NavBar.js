import React, {useState} from 'react';

function Navbar(props) {

  const [sidebar, setSidebar] = useState();

  return (
      <nav className="relative flex flex-wrap items-center justify-between px-2 py-3 bg-blue-500 mb-3">
        <div className="container px-4 mx-auto flex flex-wrap items-center justify-between">
          <div className="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
            <ul className="flex flex-col lg:flex-row list-none ml-auto">
              <li className="nav-item">
                <button onClick={ ()=>setSidebar(!sidebar) } className="cursor-pointer text-xl mr-48 leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block outline-none focus:outline-none" type="button">
                  <span className="block relative w-6 h-px rounded-sm bg-white"></span>
                  <span className="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
                  <span className="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
                </button>   {/*TODO: fix title in navbar not in middle*/}
              </li>
              <li className="nav-item">
                <a className="text-sm font-bold leading-relaxed ml-48 mr-4 py-2 whitespace-nowrap uppercase text-white" to="#">
                  Shopping Lor
                </a>
              </li>              
            </ul>

          </div>
        </div>
      </nav>
    )
}

export default Navbar;