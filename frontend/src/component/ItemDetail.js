import React, {useEffect, useState} from 'react';
import axios from 'axios';
import swal from 'sweetalert'; // package to show alert

import SideBar from "./SideNav";
//TODO: add alert for max quantity added
function ItemDetail(props) {

    const [product, setProduct] = useState({}); // store product detail for render and API call
    const [quantity, setQuantity] = useState(1);
    let productId = props.match.params.id; //get product id from param

    useEffect(() =>{

        const getProduct = async () =>{

            axios.get(`/api/product/${productId}`)
                .then((result) => {
                    setProduct(result.data.data);

                })
                .catch((err) =>{
                    console.log(err);

                })
        }
        getProduct();

        },[]) // only run on page load

    // handle decrement
    const handleDecrement = () => {
        if (quantity > 1){
            setQuantity(prevCount => prevCount - 1);
        }
    }

    // handle decrement
    const handleIncrement = () => {
        if (quantity < product.stock){
            setQuantity(prevCount => prevCount + 1);
        } else {

        }
    }

    // add the selected item and quantity to cart
    const AddToCart = (e) => {
        e.preventDefault(); //prevent refresh

        const data = {
            product_id: product.id,
            quantity: quantity,
            cost: (quantity * product.price).toFixed(2),
        }

        console.log(data);
        axios.post(`/api/cart/add-to-cart`, data)
        .then((result) =>{
            if (result.data.status === 200){ // new cart created
                swal('Success', 'Item added successfully', 'success');
            } else if (result.data.status === 201) { // old cart updated successfully
                swal('Success', 'Cart Updated', 'success');

            } else if (result.data.status === 409) { // product not found/removed
                swal('Product not found', result.data.message, 'warning');

            }
        })
        .catch((e) => {
            if (e.message === 'Request failed with status code 401'){ // user not logged in
                swal('Login To Continue', 'You are not logged in', 'warning');
            } else {
                console.log('2', e);
            }

        })

    }

    return (
        <div className="flex min-h-screen">
            <SideBar/>

            {/*container for showing product detail*/}
            <div className='mx-12 flex mx-auto border-2 my-12 rounded max-w-6xl'>
                <section className="text-gray-600 body-font overflow-hidden">
                    <div className="container px-5 py-24 mx-auto">
                        <div className="lg:w-4/5 mx-auto flex flex-wrap">
                            <img alt="ecommerce"
                                 className="lg:w-1/2 w-full lg:h-auto h-auto object-cover object-center rounded"
                                 src={product.img}/>

                            <div className="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                <h1 className="text-gray-900 text-3xl title-font font-medium mb-1">{product.name}</h1>
                                <div className="flex mb-4">
                                    <button onClick={handleDecrement} className="text-white text-center text-md font-semibold rounded-tr-md px-1 bg-gray-800 focus:bg-gray-600 focus:outline-none border border-gray-800 focus:border-gray-600">-</button>
                                    <div className='text-center w-12'>{quantity}</div>
                                    <button onClick={handleIncrement} className="text-white text-center text-md font-semibold rounded-tr-md px-1 bg-gray-800 focus:bg-gray-600 focus:outline-none border border-gray-800 focus:border-gray-600">+</button>

                                </div>
                                <p className="leading-relaxed">{product.detail}</p>
                                <div className="flex">
                                    <span className="title-font font-medium text-2xl text-gray-900">${product.price}</span>
                                    <button
                                        onClick={AddToCart}
                                        className="flex ml-auto text-white bg-gray-600 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    );

}

export default ItemDetail;