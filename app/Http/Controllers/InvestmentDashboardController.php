<?php

namespace App\Http\Controllers;

use App\Models\DataEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvestmentDashboardController extends Controller
{
    /**
     * Display investment tracking dashboard.
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfYear()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfYear()->format('Y-m-d'));
        
        $entries = DataEntry::whereBetween('entry_date', [$startDate, $endDate])
            ->with(['municipality:id,name,name_nepali', 'user:id,name'])
            ->get();
            
        $investmentData = $this->prepareInvestmentData($entries);
        
        return Inertia::render('investment-dashboard', [
            'entries' => $entries,
            'investmentData' => $investmentData,
            'dateRange' => ['start' => $startDate, 'end' => $endDate],
            'totalInvestment' => $entries->sum('amount'),
        ]);
    }

    /**
     * Prepare investment tracking data.
     */
    protected function prepareInvestmentData($entries)
    {
        return [
            'by_municipality' => $entries->groupBy('municipality_id')
                ->map(function($municipalityEntries) {
                    return [
                        'municipality' => $municipalityEntries->first()->municipality,
                        'total_amount' => $municipalityEntries->sum('amount'),
                        'count' => $municipalityEntries->count(),
                    ];
                })->values(),
            'by_month' => $entries->groupBy(function($entry) {
                return $entry->entry_date->format('Y-m');
            })->map(function($monthEntries) {
                return [
                    'total_amount' => $monthEntries->sum('amount'),
                    'count' => $monthEntries->count(),
                ];
            }),
            'trends' => $this->calculateInvestmentTrends($entries),
        ];
    }

    /**
     * Calculate investment trends.
     */
    protected function calculateInvestmentTrends($entries)
    {
        $monthlyData = $entries->groupBy(function($entry) {
            return $entry->entry_date->format('Y-m');
        })->map(function($monthEntries, $month) {
            return [
                'month' => $month,
                'amount' => $monthEntries->sum('amount'),
                'count' => $monthEntries->count(),
            ];
        })->sortKeys();
        
        return $monthlyData->values();
    }
}