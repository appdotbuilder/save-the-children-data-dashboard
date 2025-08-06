import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

interface Props {
    tags: Array<{
        id: number;
        budget_heading_english: string;
        budget_heading_nepali: string;
    }>;
    sectors: Array<{
        id: number;
        title: string;
        title_nepali: string;
    }>;
    categories: Array<{
        id: number;
        title: string;
        title_nepali: string;
    }>;
    municipalities: Array<{
        id: number;
        name: string;
        name_nepali: string;
        type: string;
    }>;
    userMunicipality: {
        id: number;
        name: string;
        name_nepali: string;
    } | null;
    currentYear: number;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Entries', href: '/data-entries' },
    { title: 'Create Entry', href: '/data-entries/create' },
];

export default function CreateDataEntry({
    tags,
    sectors,
    categories,
    municipalities,
    userMunicipality,
    currentYear,
}: Props) {
    const [language, setLanguage] = useState<'english' | 'nepali'>('english');
    
    const { data, setData, post, processing, errors } = useForm({
        budget_headline: '',
        amount: '',
        fiscal_year: currentYear,
        entry_date: new Date().toISOString().split('T')[0],
        municipality_id: userMunicipality?.id || '',
        tag_ids: [] as number[],
        sector_ids: [] as number[],
        category_ids: [] as number[],
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('data-entries.store'));
    };

    const handleTagToggle = (tagId: number) => {
        setData('tag_ids', 
            data.tag_ids.includes(tagId)
                ? data.tag_ids.filter(id => id !== tagId)
                : [...data.tag_ids, tagId]
        );
    };

    const handleSectorToggle = (sectorId: number) => {
        setData('sector_ids', 
            data.sector_ids.includes(sectorId)
                ? data.sector_ids.filter(id => id !== sectorId)
                : [...data.sector_ids, sectorId]
        );
    };

    const handleCategoryToggle = (categoryId: number) => {
        setData('category_ids', 
            data.category_ids.includes(categoryId)
                ? data.category_ids.filter(id => id !== categoryId)
                : [...data.category_ids, categoryId]
        );
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Data Entry" />
            
            <div className="max-w-4xl mx-auto">
                <div className="flex items-center justify-between mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            📝 Create Data Entry
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Add a new budget data entry to the system
                        </p>
                    </div>
                    
                    {/* Language Toggle */}
                    <div className="flex rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden">
                        <button
                            type="button"
                            onClick={() => setLanguage('english')}
                            className={`px-4 py-2 text-sm font-medium ${
                                language === 'english'
                                    ? 'bg-red-500 text-white'
                                    : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'
                            }`}
                        >
                            English
                        </button>
                        <button
                            type="button"
                            onClick={() => setLanguage('nepali')}
                            className={`px-4 py-2 text-sm font-medium ${
                                language === 'nepali'
                                    ? 'bg-red-500 text-white'
                                    : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'
                            }`}
                        >
                            नेपाली
                        </button>
                    </div>
                </div>

                <form onSubmit={submit} className="space-y-6">
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            Basic Information
                        </h2>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Budget Headline / बजेट शीर्षक *
                                </label>
                                <textarea
                                    value={data.budget_headline}
                                    onChange={(e) => setData('budget_headline', e.target.value)}
                                    rows={3}
                                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder={language === 'english' ? 'Enter budget headline...' : 'बजेट शीर्षक प्रविष्ट गर्नुहोस्...'}
                                />
                                {errors.budget_headline && (
                                    <p className="text-red-500 text-sm mt-1">{errors.budget_headline}</p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Amount (NPR) / रकम *
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    value={data.amount}
                                    onChange={(e) => setData('amount', e.target.value)}
                                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder="0.00"
                                />
                                {errors.amount && (
                                    <p className="text-red-500 text-sm mt-1">{errors.amount}</p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fiscal Year / आर्थिक वर्ष *
                                </label>
                                <input
                                    type="number"
                                    value={data.fiscal_year}
                                    onChange={(e) => setData('fiscal_year', parseInt(e.target.value))}
                                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                />
                                {errors.fiscal_year && (
                                    <p className="text-red-500 text-sm mt-1">{errors.fiscal_year}</p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Entry Date / प्रविष्टि मिति *
                                </label>
                                <input
                                    type="date"
                                    value={data.entry_date}
                                    onChange={(e) => setData('entry_date', e.target.value)}
                                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                />
                                {errors.entry_date && (
                                    <p className="text-red-500 text-sm mt-1">{errors.entry_date}</p>
                                )}
                            </div>

                            {municipalities.length > 1 && (
                                <div className="md:col-span-2">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Municipality / नगरपालिका *
                                    </label>
                                    <select
                                        value={data.municipality_id}
                                        onChange={(e) => setData('municipality_id', e.target.value)}
                                        className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    >
                                        <option value="">Select Municipality</option>
                                        {municipalities.map((municipality) => (
                                            <option key={municipality.id} value={municipality.id}>
                                                {language === 'english' ? municipality.name : municipality.name_nepali} ({municipality.type})
                                            </option>
                                        ))}
                                    </select>
                                    {errors.municipality_id && (
                                        <p className="text-red-500 text-sm mt-1">{errors.municipality_id}</p>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Tags Section */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            🏷️ Tags / ट्यागहरू
                        </h2>
                        <p className="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            Select relevant budget heading tags (multiple selection allowed)
                        </p>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            {tags.map((tag) => (
                                <label
                                    key={tag.id}
                                    className={`flex items-start space-x-3 p-3 border rounded-lg cursor-pointer transition-colors ${
                                        data.tag_ids.includes(tag.id)
                                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20'
                                            : 'border-gray-200 dark:border-gray-600 hover:border-red-300 dark:hover:border-red-400'
                                    }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={data.tag_ids.includes(tag.id)}
                                        onChange={() => handleTagToggle(tag.id)}
                                        className="mt-0.5 text-red-500 focus:ring-red-500"
                                    />
                                    <div className="text-sm">
                                        <div className="font-medium text-gray-900 dark:text-white">
                                            {language === 'english' ? tag.budget_heading_english : tag.budget_heading_nepali}
                                        </div>
                                    </div>
                                </label>
                            ))}
                        </div>
                    </div>

                    {/* Sectors Section */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            🎯 Sectors / क्षेत्रहरू
                        </h2>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            {sectors.map((sector) => (
                                <label
                                    key={sector.id}
                                    className={`flex items-center space-x-3 p-3 border rounded-lg cursor-pointer transition-colors ${
                                        data.sector_ids.includes(sector.id)
                                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20'
                                            : 'border-gray-200 dark:border-gray-600 hover:border-red-300 dark:hover:border-red-400'
                                    }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={data.sector_ids.includes(sector.id)}
                                        onChange={() => handleSectorToggle(sector.id)}
                                        className="text-red-500 focus:ring-red-500"
                                    />
                                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                                        {language === 'english' ? sector.title : sector.title_nepali}
                                    </div>
                                </label>
                            ))}
                        </div>
                    </div>

                    {/* Categories Section */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            📂 Categories / वर्गहरू
                        </h2>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            {categories.map((category) => (
                                <label
                                    key={category.id}
                                    className={`flex items-center space-x-3 p-3 border rounded-lg cursor-pointer transition-colors ${
                                        data.category_ids.includes(category.id)
                                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20'
                                            : 'border-gray-200 dark:border-gray-600 hover:border-red-300 dark:hover:border-red-400'
                                    }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={data.category_ids.includes(category.id)}
                                        onChange={() => handleCategoryToggle(category.id)}
                                        className="text-red-500 focus:ring-red-500"
                                    />
                                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                                        {language === 'english' ? category.title : category.title_nepali}
                                    </div>
                                </label>
                            ))}
                        </div>
                    </div>

                    {/* Form Actions */}
                    <div className="flex justify-end space-x-4">
                        <Button
                            type="button"
                            variant="outline"
                            onClick={() => window.history.back()}
                        >
                            Cancel
                        </Button>
                        <Button
                            type="submit"
                            disabled={processing}
                            className="bg-red-500 hover:bg-red-600"
                        >
                            {processing ? 'Creating...' : 'Create Entry'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}