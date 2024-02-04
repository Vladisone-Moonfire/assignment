'use client'

import Label from "@/components/Label";
import Input from "@/components/Input";
import InputError from "@/components/InputError";
import AuthCard from '@/app/(auth)/AuthCard'
import { useState } from 'react'
import Button from "@/components/Button";
import {useAuth} from "@/hooks/auth";

const Dashboard = () => {
    const { changeEmail, user, logout } = useAuth()
    const [email, setEmail] = useState('')
    const [errors, setErrors] = useState([])

    const submitForm = async event => {
        event.preventDefault()

        changeEmail({email, setErrors})
        setEmail("")
    }

    return (
        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 bg-white border-b border-gray-200">
                        <div className="mb-5"> You're logged in, {user.first_name} {user.last_name}!</div>
                        <div>Your email is: <span className="font-bold">{user.email}</span></div>
                    </div>

                    <div className="p-6 flex items-center justify-start my-4">
                        <Button onClick={logout}>Logout</Button>
                    </div>

                    <div className="font-sans text-gray-900 antialiased">
                        <div
                            className="min-h-[50vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                            <div
                                className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                                <div className="my-5 font-bold">Change your account email here:</div>
                                <form onSubmit={submitForm}>
                                    {/* Email Address */}
                                    <div>
                                        <Label htmlFor="email">Email</Label>

                                        <Input
                                            id="email"
                                            type="email"
                                            value={email}
                                            className="block mt-1 w-full"
                                            onChange={event => setEmail(event.target.value)}
                                            required
                                            autoFocus
                                        />

                                        <InputError messages={errors.email} className="mt-2"/>
                                    </div>

                                    <div className="flex items-center justify-end mt-4">
                                        <Button className="ml-3">Submit</Button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Dashboard
