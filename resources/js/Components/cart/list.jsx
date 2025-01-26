import React from 'react'

function List({ item}) {
   
    return (
        <li className="flex py-6" key={item.id}>
            <div className="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                <img src={"https://picsum.photos/600/400/?random&id="+item.id} className="size-full object-cover"/>
            </div>

            <div className="ml-4 flex flex-1 flex-col">
                <div>
                <div className="flex justify-between text-base font-medium text-gray-900">
                    <h3>
                    <a href="#">{item.product.name}</a>
                    </h3>
                    <p className="ml-4">RM {item.product.price}</p>
                </div>
                <p className="mt-1 text-sm text-gray-500">{item.product.description}</p>
                </div>
                <div className="flex flex-1 items-end justify-between text-sm">
                <p className="text-gray-500">Qty {item.quantity}</p>

                <div className="flex hidden">
                    <button type="button" className="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                </div>
                </div>
            </div>
        </li>  
    )
  }
  
  export default List