import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    return (
        
        <div className="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">

            <div>
                <Link href="/">
                    <ApplicationLogo className="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div className="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                {children}
            </div>

            <p className="text-sm font-light text-gray-500 dark:text-gray-400 p-2">
                Don’t have an account yet?  
                <Link
                    href={route('register')}
                    className="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >
                    Register
                </Link>
            </p>
        </div>
    );
}
