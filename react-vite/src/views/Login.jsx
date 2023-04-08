import React, { useRef, useState } from 'react'
import { Link } from 'react-router-dom';
import { useForm } from 'react-hook-form'
import axiosClient from '../axios-client';
import { useStateContext } from '../contexts/ContextProvider';

import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from 'yup'

export default function Login() {


  const userSchema = yup.object().shape({
    email: yup.string().email().required(),                                             
    password: yup.string().min(8).required(),
  })
  
  const { register, handleSubmit, watch, setError, formState, formState: { errors } } = useForm({
    mode: "onTouched",
    resolver: yupResolver(userSchema),
  })
  
  const {isSubmitting, isValid, isSubmitted, isSubmitSuccessful} = formState                   


  // const emailRef = useRef()
  // const passwordRef = useRef()
  // const [error, setError] = useState(null);


  const {setUser, setToken} = useStateContext()
  const onSubmit = (el) => {
    const payload = {
      email:el.email,
      password:el.password,
    }
    
    axiosClient.post('/login', payload)
    .then(({data}) => {
      setUser(data.user);
      setToken(data.token);
    })
    .catch(err => {
      console.log(err)
      const response = err.response;
      if (response && response.status === 422) {
        setError('server', { 
          type: response.status,
          message: response.data.message
        });
      }
    })
  }


  console.log(errors)

  return (
    <div className='login-signup-form animated fadeInDown'>
      <div className='form'>
        <form onSubmit={handleSubmit(onSubmit)}>
          <h1 className='title'> Login In to your count </h1>
          {errors.server &&
            <div className="alert">
              <p>{errors.server.message}</p>
            </div>
          }
          <input type="email" placeholder='Email' {...register('email')} />
          {errors.email && <div className='errors'> error : {errors.email?.message} </div>}
          <input type="password" placeholder='password' {...register('password')}/>
          {errors.password && <div className='errors'> error : {errors.password?.message} </div>}
          <button className='btn btn-block' disabled={isSubmitting || !isValid}> Login </button>
          <p className='message'> 
            Not Registred ? <Link to="/signup"> Create an accounts </Link>
          </p>
        </form>
      </div>
    </div>
  )
}
