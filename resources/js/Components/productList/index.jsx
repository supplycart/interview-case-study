import React from 'react'
import Product from '../product'
import { useContext} from 'react';
import {PageContext} from '../../Layouts/AuthenticatedLayout';

function ProductList({
  products,
}) {
  const setTotalCartItem = useContext(PageContext);
  
  return (
    <div className=" flex flex-wrap justify-center gap-8 max-w-5xl">
      {products.length > 0 &&
        products.map((product) => {
          return (
            <Product
              key={product.id}
              product={product}
              setTotalCartItem={setTotalCartItem}
            />
          )
        })}
    </div>
  )
}

export default ProductList
