import React, { useState } from 'react';

import SideBar from './SideNav';
import Card from './Card';

const items = [
    {
        "ProductId": 1,
        "Name": "ipsam dignissimos rerum animi maxime vel",
        "Detail": "Dolor maxime et nihil saepe velit. Temporibus ratione est est itaque dolorum quas.",
        "Stock": 25,
        "Price": 35.41,
        "Img": "https://via.placeholder.com/600x400.png/003388?text=grocery+iste"
    },
    {
        "ProductId": 2,
        "Name": "expedita et et vel sed aut",
        "Detail": "Necessitatibus dolorum laborum dolorem nihil est accusantium. Porro praesentium necessitatibus vero doloribus error tenetur sunt ullam.",
        "Stock": 2,
        "Price": 88.92,
        "Img": "https://via.placeholder.com/600x400.png/0033cc?text=grocery+velit"
    }
]


function Home() {
    const[sidebar, setSidebar] = useState(false); //control opening and closing of sidebar

    return(
        <>
        <div className="flex">
            <SideBar />

            {/*container for showing product*/}
            <div className='mx-12 flex mx-auto border-2 my-12 rounded max-w-6xl'>
                {/*<div className="flex w-60 bg-gray-200 h-96"><SideBar /></div>*/}

                <section className="text-gray-600 body-font">
                <div className="container px-5 py-8 mx-auto bg-gray-200">
                    <div className="justify-evenly flex flex-wrap -m-4">
                        <Card items={items}/>

                        <div className="m-2 rounded bg-white lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/422x262"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">Neptune</h2>
                                <p className="mt-1">$12.00</p>
                            </div>
                        </div>
                        <div className="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/423x263"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">The 400 Blows</h2>
                                <p className="mt-1">$18.40</p>
                            </div>
                        </div>
                        <div className="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/424x264"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                                <p className="mt-1">$16.00</p>
                            </div>
                        </div>
                        <div className="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/425x265"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">Shooting Stars</h2>
                                <p className="mt-1">$21.15</p>
                            </div>
                        </div>
                        <div className="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/427x267"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">Neptune</h2>
                                <p className="mt-1">$12.00</p></div>
                            </div>
                        </div>
                        <div className="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a className="block relative h-48 rounded overflow-hidden">
                                <img alt="ecommerce" className="object-cover object-center w-full h-full block"
                                     src="https://dummyimage.com/428x268"></img>
                            </a>
                            <div className="mt-4">
                                <h3 className="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                                <h2 className="text-gray-900 title-font text-lg font-medium">The 400 Blows</h2>
                                <p className="mt-1">$18.40</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        </>
        );
}

export default Home;