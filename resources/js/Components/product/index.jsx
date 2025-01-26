import React from 'react'
import {usePage } from '@inertiajs/react';

function AddToCartButton({product, setTotalCartItem }) {

  const csrf_token = usePage().props.csrf_token;

  

  const addProductToCart = async () => {
    
    try {
        await fetch("cart/add",{
          headers: {
            "X-CSRF-Token": csrf_token,
            "Content-Type": "application/json"
          },
          method: "POST",
          body: JSON.stringify(product),

        });  

        const response  = await fetch('/cart/count');
        const data = await response.json();
        setTotalCartItem(data.count)
        
    } catch (error) {
        console.log(error)
    } 
  };

  return (
    <button onClick = {addProductToCart} className="flex items-center justify-center w-full px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
      <span className="flex">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          className="w-5 h-5 mx-1"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
              d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
          />
        </svg>
        <span>Add to cart</span>
      </span> 
    </button>
  );
}


function Product({ product, setTotalCartItem,totalcartlItem}) {
  
  return (
    <div className="max-w-xs rounded overflow-hidden bg-white shadow-lg">
      <img className="w-full"  src={"https://picsum.photos/600/400/?random&id="+product.id}/>
      <div className="px-6 py-2">
        <h3 className="font-bold text-xl mb-2">{product.name}</h3>
        <p className="text-red-600 font-bold">RM {product.price}</p>
      </div>
      <div className="px-6 py-3">
        <AddToCartButton product={product} setTotalCartItem={setTotalCartItem}/>
      </div>
    </div>
  )
}

export default Product
