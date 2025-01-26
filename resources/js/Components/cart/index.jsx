import React from 'react'
import List from './list'

function Cart({ isCartOpen,setCartOpen,cartItems,checkOut}) {

    let sub_total = 0;

    const closeCart = ()=>{
        setCartOpen(false)
    }

    return (
        <div className= {isCartOpen?'relative z-10':'relative z-10 hidden'} aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
                    
            <div className="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

            <div className="fixed inset-0 overflow-hidden">
                <div className="absolute inset-0 overflow-hidden">
                <div className="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                
                    <div className="pointer-events-auto w-screen max-w-md">
                    <div className="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div className="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                        <div className="flex items-start justify-between">
                            <h2 className="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                            <div className="ml-3 flex h-7 items-center">
                            <button type="button" className="relative -m-2 p-2 text-gray-400 hover:text-gray-500" onClick={closeCart}>
                                <span className="absolute -inset-0.5"></span>
                                <span className="sr-only">Close panel</span>
                                <svg className="size-6" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                            </div>
                        </div>

                        <div className="mt-8">
                            <div className="flow-root">
                            <ul role="list" className="-my-6 divide-y divide-gray-200">
                                {cartItems.length > 0 &&
                                    cartItems.map((item,i) => {
                                    sub_total +=  item.product.price * item.quantity;
                                    if (i + 1 === item.length) {
                                        console.log(sub_total) 
                                     }
                                    return (     
                                        <List item={item} key={item.id} sub_total={sub_total}/>    
                                    )
                                })}
                            </ul>  
                            </div>
                        </div>
                        </div>

                        <div className="border-t border-gray-200 px-4 py-6 sm:px-6">
                        <div className="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <p>RM {sub_total.toFixed(2)}</p>
                        </div>
                        
                        <div className="mt-6">
                            <button className="w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-xs hover:bg-indigo-700" onClick={checkOut}>Checkout</button>
                        </div>
                        <div className="mt-6 flex justify-center text-center text-sm text-gray-500">
                            <p>
                            or
                            <button type="button" className="font-medium text-indigo-600 hover:text-indigo-500" onClick={closeCart}>
                                Continue Shopping
                                <span aria-hidden="true"> &rarr;</span>
                            </button>
                            </p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    )
}

export default Cart