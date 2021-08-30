import React from 'react';
import {Link} from 'react-router-dom';


function Card( {items} ){

    // render one card for each item
    const renderedItems = items.map(item => {
      return <div key={item.id} className="m-2 rounded bg-white lg:w-1/4 md:w-1/2 p-4 w-full">
            <Link className="block relative h-48 rounded overflow-hidden" to={`/product/${item.id}`}>
              <img alt="ecommerce" className="object-cover w-full h-full object-center block" src={item.img}/>
            </Link>
            <div className="mt-4">
              <h2 className="text-gray-500 text-lg tracking-widest title-font mb-1">{item.name}</h2>
              <h3 className="text-gray-900 title-font text-xs font-medium">{item.detail}</h3>
              <h3 className="text-gray-900 title-font text-xs font-medium">Stock: {item.stock}</h3>
              <p className="mt-1">Price: ${item.price}</p>
            </div>
        </div>

    });

  return renderedItems
}

export default Card;