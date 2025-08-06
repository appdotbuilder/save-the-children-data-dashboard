import AppLayout from '@/layouts/app-layout';

import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Props {
    totalEntries: number;
    totalAmount: string;
    recentEntries: Array<{
        id: number;
        budget_headline: string;
        amount: string;
        municipality: {
            name: string;
            name_nepali: string;
        };
        user: {
            name: string;
        };
        created_at: string;
    }>;
    municipalities: Array<{
        id: number;
        name: string;
        name_nepali: string;
        type: string;
    }>;
    userType: string;
    userMunicipality: {
        id: number;
        name: string;
        name_nepali: string;
    } | null;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ 
    totalEntries, 
    totalAmount, 
    recentEntries, 
    municipalities, 
    userType, 
    userMunicipality 
}: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            📊 Dashboard
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            {userMunicipality 
                                ? `Managing data for ${userMunicipality.name}` 
                                : 'Municipal Data Management Overview'
                            }
                        </p>
                    </div>
                    <div className="flex gap-3 mt-4 sm:mt-0">
                        <Link
                            href="/data-entries/create"
                            className="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium"
                        >
                            📝 Add Data Entry
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Entries</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">{totalEntries}</p>
                            </div>
                            <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">📋</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Amount</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">NPR {totalAmount}</p>
                            </div>
                            <div className="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">💰</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-gray-600 dark:text-gray-400 text-sm font-medium">Active Municipalities</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">{municipalities.length}</p>
                            </div>
                            <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">🏛️</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-gray-600 dark:text-gray-400 text-sm font-medium">Your Role</p>
                                <p className="text-lg font-bold text-gray-900 dark:text-white capitalize">
                                    {userType.replace('_', ' ')}
                                </p>
                            </div>
                            <div className="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">👤</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <Link 
                        href="/dashboards/municipality"
                        className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow group"
                    >
                        <div className="flex items-start justify-between">
                            <div>
                                <h3 className="font-semibold text-gray-900 dark:text-white text-lg mb-2">
                                    🏘️ Municipality Dashboard
                                </h3>
                                <p className="text-gray-600 dark:text-gray-400 text-sm">
                                    View detailed analytics for individual municipalities with date range filtering
                                </p>
                            </div>
                            <span className="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">→</span>
                        </div>
                    </Link>

                    <Link 
                        href="/dashboards/comparison"
                        className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow group"
                    >
                        <div className="flex items-start justify-between">
                            <div>
                                <h3 className="font-semibold text-gray-900 dark:text-white text-lg mb-2">
                                    📊 Comparison Dashboard
                                </h3>
                                <p className="text-gray-600 dark:text-gray-400 text-sm">
                                    Compare up to 3 municipalities side-by-side with visual charts and graphs
                                </p>
                            </div>
                            <span className="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">→</span>
                        </div>
                    </Link>

                    <Link 
                        href="/dashboards/investments"
                        className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow group"
                    >
                        <div className="flex items-start justify-between">
                            <div>
                                <h3 className="font-semibold text-gray-900 dark:text-white text-lg mb-2">
                                    📈 Investment Tracking
                                </h3>
                                <p className="text-gray-600 dark:text-gray-400 text-sm">
                                    Track investment trends and performance across all municipalities
                                </p>
                            </div>
                            <span className="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">→</span>
                        </div>
                    </Link>
                </div>

                {/* Recent Entries */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                📋 Recent Data Entries
                            </h2>
                            <Link 
                                href="/data-entries" 
                                className="text-red-500 hover:text-red-600 font-medium text-sm"
                            >
                                View All →
                            </Link>
                        </div>
                    </div>
                    
                    <div className="overflow-x-auto">
                        {recentEntries.length > 0 ? (
                            <table className="w-full">
                                <thead className="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Budget Headline
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Municipality
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Amount
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Created By
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 dark:divide-gray-700">
                                    {recentEntries.map((entry) => (
                                        <tr key={entry.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <Link 
                                                    href={`/data-entries/${entry.id}`}
                                                    className="text-red-600 hover:text-red-800 font-medium"
                                                >
                                                    {entry.budget_headline}
                                                </Link>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {entry.municipality.name}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                                NPR {entry.amount}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {entry.user.name}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {new Date(entry.created_at).toLocaleDateString()}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        ) : (
                            <div className="px-6 py-12 text-center">
                                <div className="text-gray-400 text-4xl mb-4">📝</div>
                                <p className="text-gray-500 dark:text-gray-400 text-lg mb-4">No data entries yet</p>
                                <p className="text-gray-400 text-sm mb-6">Start by creating your first data entry</p>
                                <Link
                                    href="/data-entries/create"
                                    className="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-colors font-medium inline-block"
                                >
                                    Create First Entry
                                </Link>
                            </div>
                        )}
                    </div>
                </div>

                {/* Admin Controls */}
                {(userType === 'super_admin' || userType === 'admin') && (
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                ⚙️ Administration
                            </h2>
                        </div>
                        
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <Link
                                    href="/admin/tags"
                                    className="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <span className="text-2xl mr-3">🏷️</span>
                                    <div>
                                        <div className="font-medium text-gray-900 dark:text-white">Manage Tags</div>
                                        <div className="text-sm text-gray-500 dark:text-gray-400">Budget headings</div>
                                    </div>
                                </Link>

                                <Link
                                    href="/admin/sectors"
                                    className="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <span className="text-2xl mr-3">🎯</span>
                                    <div>
                                        <div className="font-medium text-gray-900 dark:text-white">Manage Sectors</div>
                                        <div className="text-sm text-gray-500 dark:text-gray-400">Sector categories</div>
                                    </div>
                                </Link>

                                <Link
                                    href="/admin/categories"
                                    className="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <span className="text-2xl mr-3">📂</span>
                                    <div>
                                        <div className="font-medium text-gray-900 dark:text-white">Manage Categories</div>
                                        <div className="text-sm text-gray-500 dark:text-gray-400">Data categories</div>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}