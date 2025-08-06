import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Save the Children - Data Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
                {/* Navigation */}
                <header className="absolute top-0 w-full z-10">
                    <nav className="flex items-center justify-between p-6 lg:px-8">
                        <div className="flex items-center space-x-3">
                            <div className="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold text-sm">SC</span>
                            </div>
                            <span className="font-semibold text-gray-900 dark:text-white">Save the Children</span>
                        </div>
                        <div className="flex items-center space-x-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white font-medium"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <main className="pt-32 pb-20 px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center">
                            <h1 className="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                                📊 Municipal Data
                                <br />
                                <span className="text-red-500">Management System</span>
                            </h1>
                            <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                                Supporting Save the Children's mission with comprehensive data tracking, 
                                role-based access control, and powerful analytics for municipal budget management 
                                across Nepal. <span className="font-medium">English & Nepali bilingual support</span> 🇳🇵
                            </p>
                            
                            {!auth.user && (
                                <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                                    <Link
                                        href={route('register')}
                                        className="bg-red-500 text-white px-8 py-4 rounded-lg hover:bg-red-600 transition-colors font-semibold text-lg"
                                    >
                                        Get Started →
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="border-2 border-red-500 text-red-500 px-8 py-4 rounded-lg hover:bg-red-50 transition-colors font-semibold text-lg"
                                    >
                                        Sign In
                                    </Link>
                                </div>
                            )}
                        </div>

                        {/* Features Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">👥</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Role-Based Access
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Secure access control with Super Admin, Admin, Palika User, and Viewer roles. 
                                    Each role has specific permissions tailored to their responsibilities.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🏷️</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Smart Tag Management
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Organize budget data with intelligent tagging system. Admin users can create 
                                    and manage tags with both English and Nepali labels for better accessibility.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📈</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Interactive Dashboards
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Three specialized dashboards: Individual Municipality view, Comparison dashboard 
                                    for up to 3 municipalities, and Investment Tracking with visual analytics.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📝</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Data Entry Forms
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Simple, intuitive forms for budget data entry with multi-select tags, sectors, 
                                    and categories. Designed for users with minimal digital literacy.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🏛️</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Municipality Focus
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Track both rural and urban municipalities with district-wise organization. 
                                    Palika users can edit their own data while maintaining data integrity.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                <div className="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🔒</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Secure & Scalable
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Built with Laravel and PostgreSQL for enterprise-grade security and performance. 
                                    Responsive design works on all devices with accessibility features.
                                </p>
                            </div>
                        </div>

                        {/* Categories Preview */}
                        <div className="mt-20 text-center">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                                Predefined Categories
                            </h2>
                            <div className="flex flex-wrap justify-center gap-4">
                                {[
                                    { en: 'Survival', np: 'अस्तित्व', color: 'bg-blue-100 text-blue-800' },
                                    { en: 'Protection', np: 'संरक्षण', color: 'bg-green-100 text-green-800' },
                                    { en: 'Development', np: 'विकास', color: 'bg-purple-100 text-purple-800' },
                                    { en: 'Participation', np: 'सहभागिता', color: 'bg-yellow-100 text-yellow-800' },
                                    { en: 'Institutional', np: 'संस्थागत', color: 'bg-red-100 text-red-800' },
                                    { en: 'Extracting', np: 'निकासी', color: 'bg-indigo-100 text-indigo-800' },
                                ].map((category, index) => (
                                    <span
                                        key={index}
                                        className={`px-4 py-2 rounded-full font-medium ${category.color}`}
                                    >
                                        {category.en} / {category.np}
                                    </span>
                                ))}
                            </div>
                        </div>

                        {/* CTA Section */}
                        {!auth.user && (
                            <div className="mt-20 bg-red-500 rounded-2xl p-12 text-center">
                                <h2 className="text-3xl font-bold text-white mb-4">
                                    Ready to Get Started?
                                </h2>
                                <p className="text-red-100 text-lg mb-8 max-w-2xl mx-auto">
                                    Join the Save the Children data management system and help track 
                                    municipal investments for better child welfare outcomes across Nepal.
                                </p>
                                <Link
                                    href={route('register')}
                                    className="bg-white text-red-500 px-8 py-4 rounded-lg hover:bg-red-50 transition-colors font-semibold text-lg inline-block"
                                >
                                    Create Your Account →
                                </Link>
                            </div>
                        )}
                    </div>
                </main>

                {/* Footer */}
                <footer className="border-t border-gray-200 dark:border-gray-700 py-8">
                    <div className="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                        <p className="text-gray-600 dark:text-gray-400">
                            Built with ❤️ for{' '}
                            <span className="font-semibold text-red-500">Save the Children</span> 
                            {' '}- Empowering communities through data-driven decisions
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}