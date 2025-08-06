import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Props {
    municipalities: Array<{
        id: number;
        name: string;
        name_nepali: string;
        type: string;
    }>;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Municipality Dashboard', href: '/dashboards/municipality' },
];

export default function MunicipalitySelector({ municipalities }: Props) {
    const ruralMunicipalities = municipalities.filter(m => m.type === 'rural');
    const urbanMunicipalities = municipalities.filter(m => m.type === 'urban');

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Select Municipality" />
            
            <div className="max-w-4xl mx-auto">
                <div className="text-center mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        🏘️ Select Municipality
                    </h1>
                    <p className="text-gray-600 dark:text-gray-400 text-lg">
                        Choose a municipality to view its detailed dashboard and analytics
                    </p>
                </div>

                {/* Urban Municipalities */}
                {urbanMunicipalities.length > 0 && (
                    <div className="mb-8">
                        <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            🏙️ Urban Municipalities
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {urbanMunicipalities.map((municipality) => (
                                <Link
                                    key={municipality.id}
                                    href={`/dashboards/municipality/${municipality.id}`}
                                    className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-red-300 dark:hover:border-red-400 transition-all group"
                                >
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <h3 className="font-semibold text-gray-900 dark:text-white text-lg mb-1">
                                                {municipality.name}
                                            </h3>
                                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                                {municipality.name_nepali}
                                            </p>
                                            <span className="inline-block mt-2 px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium rounded-full">
                                                Urban Municipality
                                            </span>
                                        </div>
                                        <span className="text-gray-400 group-hover:text-red-500 transition-colors">→</span>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                )}

                {/* Rural Municipalities */}
                {ruralMunicipalities.length > 0 && (
                    <div>
                        <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            🌾 Rural Municipalities
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {ruralMunicipalities.map((municipality) => (
                                <Link
                                    key={municipality.id}
                                    href={`/dashboards/municipality/${municipality.id}`}
                                    className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-red-300 dark:hover:border-red-400 transition-all group"
                                >
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <h3 className="font-semibold text-gray-900 dark:text-white text-lg mb-1">
                                                {municipality.name}
                                            </h3>
                                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                                {municipality.name_nepali}
                                            </p>
                                            <span className="inline-block mt-2 px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-medium rounded-full">
                                                Rural Municipality
                                            </span>
                                        </div>
                                        <span className="text-gray-400 group-hover:text-red-500 transition-colors">→</span>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                )}

                {municipalities.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-gray-400 text-6xl mb-4">🏛️</div>
                        <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            No Municipalities Available
                        </h2>
                        <p className="text-gray-600 dark:text-gray-400">
                            No active municipalities found in the system.
                        </p>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}