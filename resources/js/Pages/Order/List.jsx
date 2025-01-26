import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head,Link } from '@inertiajs/react';
import moment from 'moment';

export default function List({ orders }) {

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    My Orders
                </h2>
            }  
        >
            <Head title="Orders" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg"></div>
                    <section className="flex justify-center min-h-screen min-w-screen py-12 ">
                    <div className="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                        <table className="w-full text-left table-auto min-w-max">
                            <thead>
                            <tr>
                                <th className="p-4 border-b border-slate-300 bg-slate-50">
                                    <p className="block text-sm font-normal leading-none text-slate-500">
                                        Invoice Number
                                    </p>
                                </th>
                        
                                <th className="p-4 border-b border-slate-300 bg-slate-50">
                                    <p className="block text-sm font-normal leading-none text-slate-500">
                                        Amount
                                    </p>
                                </th>
                                <th className="p-4 border-b border-slate-300 bg-slate-50">
                                    <p className="block text-sm font-normal leading-none text-slate-500">
                                        Order Date
                                    </p>
                                </th>
                                <th className="p-4 border-b border-slate-300 bg-slate-50">
                                    <p className="block text-sm font-normal leading-none text-slate-500">
                                        Action
                                    </p>
                                </th>
                            
                            </tr>
                            </thead>
                            <tbody>
                                {orders.length > 0 ?
                                    orders.map((order) => {
                                    return (
                                        <tr className="hover:bg-slate-50" key={order.id}>
                                            <td className="p-4 border-b border-slate-200 py-5">
                                                <p className="block font-semibold text-sm text-slate-800">{order.invoice_number}</p>
                                            </td>
                                            <td className="p-4 border-b border-slate-200 py-5">
                                                <p className="text-sm text-slate-500">RM {order.sub_total}</p>
                                            </td>
                                            <td className="p-4 border-b border-slate-200 py-5">
                                                <p className="text-sm text-slate-500">{moment(order.created_at).format("DD-MM-YYYY hh:mm:ss A")}</p>
                                            </td>
                                            <td className="p-4 border-b border-slate-200 py-5">
                                                <Link href={"/order/summary/"+order.id} >View Details</Link>
                                            </td>
                                        </tr> 
                                    )
                                    }): (
                                        <tr className="hover:bg-slate-50">
                                            <td className="p-4 border-b border-slate-200 py-5">
                                            <p className="block font-semibold text-sm text-slate-800">No records found</p>
                                            </td>  
                                        </tr> 
                                    )
                                }
                                            
                            </tbody>
                        </table>
                    </div>
                    </section>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
