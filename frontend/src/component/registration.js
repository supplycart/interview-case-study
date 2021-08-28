import React, {useEffect, useState} from 'react';
import axios from 'axios';
import {Link} from "react-router-dom";

function Registration() {

    const [status, setStatus] = useState(0); // store return value from API call
    const [registerInput, setRegisterInput] = useState({
        email: '',
        password: '',
        success: '',
        username: '',
        message: {
            email: '',
            password: '',
            username: ''
        }
    })

    const handleFormSubmit = (e) => {
        e.preventDefault();

         let data = {
            email: e.target.elements.email?.value,
            password: e.target.elements.password?.value,
            username: e.target.elements.username?.value,
             success: '',
             message: {
                 email: '',
                 password: '',
                 username: ''
             }
        }

        // update useState of user input
        setRegisterInput({...registerInput, ...data});

        // update sendingState to trigger useEffect;
        setStatus(status+1);
    }

    useEffect(() => {

       const register = async () => {

            axios.post('api/register', {
                username: registerInput.username,
                email: registerInput.email,
                password: registerInput.password
            })
              .then((response) =>{

                     // register success
                    if (response.status === 200){
                        let data = {
                            success:'Registration successful'
                        }
                        setInput(data);
                    }
                })
                .catch((err) => {
                    let data = {
                        message: {
                            email: err.response.data.errors.email,
                            password: err.response.data.errors.password,
                            username: err.response.data.errors.username,
                        }
                    }
                    setInput(data);
                })

        };

       if (status !== 0){ // prevent API call when reloading and first landing
           register();
       }

       //TODO: use cleanup function to clean registerInput useState

    }, [status]);

    //TODO: fix error not showing correctly
    // function to set state to registerInput inside useEffect
    function setInput(data){
        console.log('Data ', data);
        setRegisterInput({...registerInput, ...data})
        console.log(registerInput);
    }

    return(
        <div className='h-screen flex bg-gray-bg1'>
            <div className='w-full max-w-md m-auto bg-white rounded-lg border border-primaryBorder shadow-default py-10 px-16'>
                <h1 className='text-2xl font-medium text-primary mt-4 mb-12 text-center'>
                    Register for an account 🔐
                </h1>
                <span className='text-green-500 font-serif semi-bold'>{registerInput.success}</span>  {/*to show error message*/}
                <span className='text-red-500 semi-bold'>{registerInput.message.username}</span>  {/*to show error message*/}
                <form onSubmit={handleFormSubmit}>
                    <div>
                        <label htmlFor='text'>Username</label>
                        <input
                            type='text'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            id='username'
                            placeholder='Username'
                        />
                    </div>
                    <span className='text-red-500 semi-bold'>{registerInput.message.email}</span>  {/*to show error message*/}
                    <div>
                        <label htmlFor='email'>Email</label>
                        <input
                            type='email'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            id='email'
                            placeholder='Your Email'
                        />
                    </div>
                    <span className='text-red-500 semi-bold'>{registerInput.message.username}</span>  {/*to show error message*/}
                    <div>
                        <label htmlFor='password'>Password</label>
                        <input
                            type='password'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            id='password'
                            placeholder='Your Password'
                        />
                    </div>

                    <div className='flex justify-center items-center mt-6'>
                        <button
                            className={`bg-green-500 hover:bg-green-700 py-2 px-4 text-sm text-white rounded border border-green`}
                        >
                            Resigter
                        </button>
                        <Link
                            className={`bg-green-500 hover:bg-green-700 py-2 px-4 text-sm text-white rounded border border-green`}
                            to='/login'
                        >
                            Login
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    )
}

export default Registration;