import React, {useEffect, useState} from 'react';
import SideBar from "./SideNav";
import axios from 'axios';

function ItemDetail(props) {

    const [product, setProduct] = useState({}); // store product detail for render
    let productId = props.match.params.id; //get product id from param

    useEffect(() =>{

        const getProduct = async () =>{

            axios.get(`/product/${productId}`)
                .then((result) => {
                    setProduct(result.data.data);

                })
                .catch((err) =>{
                    console.log(err);

                })
        }
        getProduct();

        },[]) // only run on page load

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
                                </div>
                                <p className="leading-relaxed">{product.detail}</p>
                                <div className="flex">
                                    <span className="title-font font-medium text-2xl text-gray-900">${product.price}</span>
                                    <button
                                        className="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to Cart
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