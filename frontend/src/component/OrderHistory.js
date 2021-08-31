import React, {useEffect, useState} from "react";
import axios from "axios";
import SideBar from "./SideNav";
import swal from "sweetalert";
import {useHistory} from "react-router-dom";

function OrderHistory(){

    let history = useHistory();
    const [orders, setOrder] = useState([]);
    const [loading, setLoading] = useState(true);

    const fetctData = () => {
        axios.get('/api/order')
            .then(result => {
                setOrder(result.data.data);
                setLoading(false);

            })
            .catch((err) =>{
                if (err.message === 'Request failed with status code 401'){ // user not logged in
                    swal('Login To Continue', 'You are not logged in', 'warning');
                    history.push('/login'); //redirect to login

                } else {
                    console.log('2', err);
                }
            });
    }

    useEffect(() => {
        fetctData();
    }, []);

    const renderTable = () => {
        let output;

        if (orders.length !== 0){
            output = orders.map((order) => {
                return (
                    <tr key={order.id}>
                        <td className="px-6 py-4 whitespace-wrap">
                            <div className="ml-4">
                                <div className="text-base text-center font-medium text-gray-900">{order.id}</div>
                            </div>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap">
                            <div className="flex items-center">
                                <div className="flex-shrink-0 h-10 w-10">
                                    <img className="h-10 w-10" src={order.img} alt=""/>
                                </div>
                                <div className="ml-4">
                                    <div className="text-base font-medium text-gray-900">{order.product_name}</div>
                                </div>
                            </div>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap">
                          <span
                              className="px-2 text-center text-base leading-5 font-semibold">
                            ${order.price}
                          </span>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-base text-center text-gray-500">{order.quantity}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-base text-center text-gray-500">{order.cost}</td>
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
                                <h2 className='text-center text-2xl font-semibold text-gray-700'>Order History</h2>
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
                                                            Order Number
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
                    </div>
                </div>
            </>
        );
    }



}

export default OrderHistory;