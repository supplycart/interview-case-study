import React from 'react';
import {Link} from 'react-router-dom';


function Card( {items} ){

    console.log(items.length);

    // render one card for each item
    const renderedItems = items.map(item => {
      return <div key={item.ProductId} className="m-2 rounded bg-white lg:w-1/4 md:w-1/2 p-4 w-full">
            <Link className="block relative h-48 rounded overflow-hidden" to='/'>
              <img alt="ecommerce" className="object-cover w-full h-full object-center block"
                   src={item.Img}></img>
            </Link>
            <div className="mt-4">
              <h3 className="text-gray-500 text-lg tracking-widest title-font mb-1">{item.Name}</h3>
              <h2 className="text-gray-900 title-font text-xs font-medium">{item.Detail}</h2>
              <p className="mt-1">Price: ${item.Price}</p>
            </div>
        </div>

    });

  return renderedItems
}

export default Card;