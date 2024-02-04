import LoginLinks from '@/app/LoginLinks'
import Button from "@/components/Button";
import Link from "next/link";

export const metadata = {
    title: 'Laravel',
}

const Home = () => {
    return (
        <>
            <div className="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <LoginLinks />

                <div className="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div className="mb-5">You are not logged in.</div>
                    <div>Click below to login or to create an account</div>
                    <div className="mt-10">
                        <Button className="ml-3">
                            <Link
                                href="/login"
                                className="text-sm text-gray-700 no-underline"
                            >
                                Login
                            </Link>
                        </Button>
                        <Button className="ml-3">
                            <Link
                                href="/register"
                                className="text-sm text-gray-700 no-underline"
                            >
                                Register
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Home
