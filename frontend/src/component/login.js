import React, {useState} from 'react';
import axios from 'axios';
import {useHistory} from "react-router-dom";
import swal from 'sweetalert';

function Login() {

    let history = useHistory();
    const [input, setInput] = useState({
        email: '',
        password: '',
        error: []
    });

    // update useState value everytime input changes
    const handleInput = (e) => {
        setInput({...input, [e.target.name]: e.target.value});
    }

    const handleFormSubmit = (e) => {
        e.preventDefault();

        axios.get('/sanctum/csrf-cookie') // solve csrf error
            .then(response => {

                let data = {
                    password: input.password,
                    email: input.email
                }

                axios.post(`/api/login`, data)
                .then((result) => {

                    if(result.data.status === 200){

                        // store token in local storage for authentication later
                        localStorage.setItem('auth_token', result.data.token);
                        localStorage.setItem('auth_name', result.data.username);
                        swal('Success', 'Welcome', 'success');
                        history.push('/home');

                    } else {

                    }

                })
                .catch(e =>{
                    console.log(e);
                })
            });
    };


    return(
            <div className='h-screen flex bg-gray-bg1'>
                <div className='w-full max-w-md m-auto bg-white rounded-lg border border-primaryBorder shadow-default py-10 px-16'>
                    <h1 className='text-2xl font-medium text-primary mt-4 mb-12 text-center'>
                        Log in to your account 🔐
                    </h1>

                    {/*login form*/}
                    <form onSubmit={handleFormSubmit}>
                        <span className='text-red-500 font-serif semi-bold'>{input.error.email}</span>  {/*to show error message*/}
                        <div>
                            <label htmlFor='email'>Email</label>
                            <input
                                type='email'
                                value={input.email}
                                onChange={handleInput}
                                className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                                name='email'
                                placeholder='Your Email'
                            />
                        </div>
                        <span className='text-red-500 font-serif semi-bold'>{input.error.password}</span>  {/*to show error message*/}
                        <div>
                            <label htmlFor='password'>Password</label>
                            <input
                                type='password'
                                onChange={handleInput}
                                value={input.password}
                                className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                                name='password'
                                placeholder='Your Password'
                            />
                        </div>
    
                        <div className='flex justify-center items-center mt-6'>
                            <button
                                className={`bg-green-500 hover:bg-green-700 py-2 px-4 text-sm text-white rounded border border-green`}
                            >Login</button>
                        </div>
                    </form>
                </div>
            </div>
    )
}

export default Login;