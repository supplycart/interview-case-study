import React, {useEffect, useState} from 'react';
import axios from "axios";
import swal from 'sweetalert';

import SideBar from "./SideNav";
import {useHistory} from "react-router-dom";

function Cart() {

    let history = useHistory();
    const [carts, setCart] = useState([]);
    const [loading, setLoading] = useState(true);
    const [totalPrice, setTotalPrice] = useState(0);
    const [selectedCart, setSelectedCart] = useState([]);

    const fetctData = () => {
        axios.get('/api/cart/find-cart')
            .then(result => {
                setCart(result.data.data);
                setLoading(false);

            });
    }

    useEffect(() => {
        fetctData();
    }, []);

    const handleSelected = (e) => {

        // if checked cart to checkout
        if (e.target.checked){
            setTotalPrice(totalPrice + getPrice(e.target.id)) // add product price to total price
            setSelectedCart(arr => [...arr, parseInt(e.target.id)]) // update selected cart id list

        } else { // if unchecked
            setTotalPrice(totalPrice - getPrice(e.target.id))

            // get index of item in selectedCart array and remove
            let cartIndex = selectedCart.indexOf(parseInt(e.target.id));
            selectedCart.splice(cartIndex, 1);
        }
    }

    // get the price of product by id
    const getPrice = (id) => {
        for (let i=0; i<carts.length; i++){
            if (carts[i].id == id){
                return carts[i].cost;
            }
        }
        return 0;
    }

    // checkout the selected item on cart
    const checkOut = () =>{

        if (totalPrice <= 0){

        } else {
            // call api to checkout
            let data = {
                carts: selectedCart
            }
            axios.post('/api/cart/checkout', data)
                .then((result) => {
                    if (result.data.status === 200){
                        swal('Success', 'Item bought', 'success');
                        window.location.reload(); //reload to reload table

                    } else {

                    }
                })
                .catch((err) =>{
                    if (err.message === 'Request failed with status code 401'){ // user not logged in
                        swal('Login To Continue', 'You are not logged in', 'warning');
                        history.push('/login'); //redirect to login

                    } else {
                        console.log('2', err);
                    }
                })

        }

    }

    // render content of table after API data fetched
    const renderTable = () => {

        let output;

        if (carts !== undefined){
            output = carts.map((cart) => {
                return (
                    <tr key={cart.id}>
                        <td className='px-6 py-4 whitespace-nowrap'>
                            <input type="checkbox" onClick={handleSelected}  id={cart.id} className="checkbox checkbox-lg" />
                        </td>
                        <td className="px-6 py-4 whitespace-wrap">
                            <div className="ml-4">
                                <div className="text-base font-medium text-gray-900">{cart.id}</div>
                            </div>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap">
                            <div className="flex items-center">
                                <div className="flex-shrink-0 h-10 w-10">
                                    <img className="h-10 w-10" src={cart.img} alt=""/>
                                </div>
                                <div className="ml-4">
                                    <div className="text-base font-medium text-gray-900">{cart.name}</div>
                                </div>
                            </div>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap">
                          <span
                              className="px-2 text-center text-base leading-5 font-semibold">
                            ${cart.price}
                          </span>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-base text-center text-gray-500">{cart.quantity}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-base text-center text-gray-500">{cart.cost}</td>
                    </tr>

                );
            })

        } else {
            return (
                <tr>
                    <td className="px-6 py-4 whitespace-wrap"/>
                    <td className="px-6 py-4 whitespace-wrap"/>
                    <td className="px-6 py-4 whitespace-wrap">
                        <div>Empty Table</div>
                    </td>
                    <td className="px-6 py-4 whitespace-wrap"/>
                    <td className="px-6 py-4 whitespace-wrap"/>
                    <td className="px-6 py-4 whitespace-wrap"/>
                </tr>
            );
        }
        return output;
    }

    if (loading) {
        return <p className='text-center'>Loading.....</p>;

    } else {
        return (
            <>
                <div className="flex min-h-screen">
                    <SideBar/>


                    <div className='flex flex-col mx-auto max-w-6xl'>
                        {/*//page title*/}
                        <div className='flex flex-row mx-12 mx-auto mt-10 max-w-6xl'>
                            <div className='self-center flex-grow'>
                                <h2 className='text-center text-2xl font-semibold text-gray-700'>Cart</h2>
                            </div>
                            <div className='p-4'>
                                <h2 className='self-end text-center place-self-end text-2xl font-semibold text-gray-700'>Total Price: {totalPrice}</h2>
                            </div>
                        </div>

                        {/*container for showing cart*/}
                        <section className="text-gray-600 body-font my-4">
                            <div className="container px-5 py-8 mx-auto bg-gray-200">
                                <div className="flex flex-col">
                                    <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            {/*cart table*/}
                                            <div
                                                className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table className="min-w-full divide-y divide-gray-200">
                                                    <thead className="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Select
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Cart Id
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Name
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Price
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Quantity
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-6 py-3 text-center text-xm font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Total Cost
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody className="bg-white divide-y divide-gray-200">
                                                    {renderTable()}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div className='self-end ml-8'>
                            <button
                                onClick={checkOut}
                                className='text-gray-600 rounded hover:text-white hover:bg-gray-800 text-sm px-4 py-2  border rounded-full'
                            >Checkout</button>
                        </div>
                    </div>
                </div>
            </>
        );
    }
}


export default Cart;