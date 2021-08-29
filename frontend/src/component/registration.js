import React, {useState} from 'react';
import axios from 'axios';
import {Link, useHistory} from "react-router-dom";
import swal from 'sweetalert';

function Registration() {

    let history = useHistory();
    const [registerInput, setRegisterInput] = useState({
        username: '',
        email: '',
        password: '',
        error: []
    });

    // update useState value everytime input changes
    const handleInput = (e) => {
        setRegisterInput({...registerInput, [e.target.name]: e.target.value});
    }

    const handleFormSubmit = (e) => {
        e.preventDefault();
         let data = {
             username: registerInput.email,
             password: registerInput.password,
             email: registerInput.email,
         }

        axios.get('/sanctum/csrf-cookie') // solve csrf error
            .then(response => {
                axios.post(`/api/register`, data)
                    .then((res) =>{

                        // register success
                        if (res.data.status === 200){
                            // set token inside local storage
                            localStorage.setItem('auth_token', res.data.token);
                            localStorage.setItem('auth_name', res.data.email);

                            //redirect user to login
                            swal("Success", 'Registration Successful', 'success');
                            history.push('/login');

                        } else {
                            setRegisterInput({ ...registerInput, error: res.data.validation_errors })
                        }

                    })
                    .catch((err) => {
                        console.log(err);
                    })
        });


    }

    return(
        <div className='h-screen flex bg-gray-bg1'>
            <div className='w-full max-w-md m-auto bg-white rounded-lg border border-primaryBorder shadow-default py-10 px-16'>
                <h1 className='text-2xl font-medium text-primary mt-4 mb-12 text-center'>
                    Register for an account 🔐
                </h1>
                {/*registration form*/}
                <form onSubmit={handleFormSubmit}>
                    <span className='text-red-500 font-serif semi-bold'>{registerInput.error.username}</span>  {/*to show error message*/}
                    <div>
                        <label htmlFor='text'>Username</label>
                        <input
                            type='text'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            name='username'
                            onChange={handleInput}
                            value={registerInput.username}
                            placeholder='Username'
                        />
                    </div>
                    <span className='text-red-500 semi-bold'>{registerInput.error.email}</span>  {/*to show error message*/}
                    <div>
                        <label htmlFor='email'>Email</label>
                        <input
                            type='email'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            name='email'
                            onChange={handleInput}
                            value={registerInput.email}
                            placeholder='Your Email'
                        />
                    </div>
                    {/*input field*/}
                    <span className='text-red-500 semi-bold'>{registerInput.error.password}</span>  {/*to show error message*/}
                    <div>
                        <label htmlFor='password'>Password</label>
                        <input
                            type='password'
                            className={`w-full p-2 text-primary border rounded-md outline-none text-sm transition duration-150 ease-in-out mb-4`}
                            name='password'
                            onChange={handleInput}
                            value={registerInput.password}
                            placeholder='Your Password'
                        />
                    </div>

                    {/*button for register and login*/}
                    <div className='flex justify-center items-center mt-6'>
                        <button
                            onClick={handleFormSubmit}
                            className={`bg-green-500 hover:bg-green-700 py-2 px-4 text-sm text-white rounded border border-green`}
                        >Resigter</button>

                        <Link
                            className={`bg-green-500 hover:bg-green-700 py-2 px-4 text-sm text-white rounded border border-green`}
                            to='/login'
                        >Login</Link>
                    </div>
                </form>
            </div>
        </div>
    )
}

export default Registration;