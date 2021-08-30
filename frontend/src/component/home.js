import React, {useEffect, useState} from 'react';
import axios from 'axios';

import SideBar from './SideNav';
import Card from './Card';

function Home() {

    const [items, setItems] = useState();
    const [loading, setLoading] = useState(true);

    const fetctData = () => {
        axios.get('/api/product')
            .then(result => {
                setItems(result.data.data);
                setLoading(false);
            });
    }

    useEffect(() => {
        fetctData();
    }, []);


    if (loading){
        return <p className='text-center'>Loading.....</p>;
    } else {
        return(
            <>
                <div className="flex">
                    <SideBar />

                    <div className='mx-12 flex mx-auto border-2 my-12 rounded max-w-6xl'>

                        {/*container for showing product*/}
                        <section className="text-gray-600 body-font">
                            <div className="container px-5 py-8 mx-auto bg-gray-200">
                                <div className="justify-evenly flex flex-wrap -m-4">
                                    <Card items={items}/>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </>
       );

    }

}

export default Home;