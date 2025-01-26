import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import moment from 'moment';

export default function List({ order }) {

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Order Summary
                </h2>
            }  
        >
            <Head title="Orders" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg"></div>
                    <section className="py-24 relative">
                        <div className="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                            <h2 className="font-manrope font-bold text-4xl leading-10 text-black text-center">
                                Payment Successful
                            </h2>
                            <p className="mt-4 font-normal text-lg leading-8 text-gray-500 mb-11 text-center">Thanks for making a purchase
                                you can
                                check our order summary from below</p>
                            <div className="main-box border border-gray-200 rounded-xl pt-6 max-w-xl max-lg:mx-auto lg:max-w-full">
                                <div
                                    className="flex flex-col lg:flex-row lg:items-center justify-between px-6 pb-6 border-b border-gray-200">
                                    <div className="data">
                                        <p className="font-semibold text-base leading-7 text-black">Order Id: <span className="text-indigo-600 font-medium">{order.invoice_number}</span></p>
                                        <p className="font-semibold text-base leading-7 text-black mt-4">Order Payment : <span className="text-gray-400 font-medium">{moment(order.created_at).format("DD-MM-YYYY hh:mm:ss A")}</span></p>
                                    </div>
                                  
                                </div>
                                <div className="w-full px-3 min-[400px]:px-6">
                                    {order.order_items.length > 0 &&
                                        order.order_items.map((item) => {
                                            return (
                                                <div className="flex flex-col lg:flex-row items-center py-6 border-b border-gray-200 gap-6 w-full" key={item.id}>
                                                    <div className="img-box max-lg:w-full">
                                                        <img src={"https://picsum.photos/600/400/?random&id="+item.id}alt="" 
                                                            className="aspect-square w-full lg:max-w-[140px] rounded-xl object-cover" />
                                                    </div>
                                                    <div className="flex flex-row items-center w-full ">
                                                        <div className="grid grid-cols-1 lg:grid-cols-2 w-full">
                                                            <div className="flex items-center">
                                                                <div className="">
                                                                    <h2 className="font-semibold text-xl leading-8 text-black mb-3">
                                                                        {item.product.name}</h2>
                                                                    <p className="font-normal text-lg leading-8 text-gray-500 mb-3 ">
                                                                    {item.product.description}</p>
                                                                    <div className="flex items-center ">
                                                                        <p className="font-medium text-base leading-7 text-black ">Qty: <span
                                                                                className="text-gray-500">{item.quantity}</span></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div className="grid grid-cols-5">
                                                                <div className="col-span-5 lg:col-span-1 flex items-center max-lg:mt-3">
                                                                    <div className="flex gap-3 lg:block">
                                                                        <p className="font-medium text-sm leading-7 text-black">price</p>
                                                                        <p className="lg:mt-4 font-medium text-sm leading-7 text-indigo-600">RM {item.product.price}</p>
                                                                    </div>
                                                                </div>
                                                                <div className="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3 ">
                                                                    <div className="flex gap-3 lg:block">
                                                                        <p className="font-medium text-sm leading-7 text-black">Status
                                                                        </p>
                                                                        <p
                                                                            className="font-medium text-sm leading-6 whitespace-nowrap py-0.5 px-3 rounded-full lg:mt-3 bg-emerald-50 text-emerald-600">
                                                                            Paid</p>
                                                                    </div>

                                                                </div>
                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            )
                                        })
                                    }           
                                </div>
                                <div className="w-full border-t border-gray-200 px-6 flex flex-col lg:flex-row items-center justify-between ">             
                                    <p className="font-semibold text-lg text-black py-6">Total Price: <span className="text-indigo-600"> RM {order.sub_total}</span></p>
                                </div>

                            </div>
                        </div>
                    </section>
                                            
                </div>
            </div>
        </AuthenticatedLayout>
    );
}