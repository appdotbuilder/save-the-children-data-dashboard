<?php

namespace App\Http\Controllers;

use App\Models\DataEntry;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComparisonDashboardController extends Controller
{
    /**
     * Display comparison dashboard.
     */
    public function index(Request $request)
    {
        $municipalityIds = $request->get('municipalities', []);
        $startDate = $request->get('start_date', now()->startOfYear()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfYear()->format('Y-m-d'));
        
        if (count($municipalityIds) > 3) {
            $municipalityIds = array_slice($municipalityIds, 0, 3);
        }
        
        $municipalities = Municipality::whereIn('id', $municipalityIds)->get();
        $comparisonData = [];
        
        foreach ($municipalities as $municipality) {
            $entries = DataEntry::where('municipality_id', $municipality->id)
                ->whereBetween('entry_date', [$startDate, $endDate])
                ->get();
                
            $comparisonData[] = [
                'municipality' => $municipality,
                'totalAmount' => $entries->sum('amount'),
                'totalEntries' => $entries->count(),
                'chartData' => $this->prepareMunicipalityChartData($entries),
            ];
        }
        
        return Inertia::render('comparison-dashboard', [
            'municipalities' => Municipality::active()->get(['id', 'name', 'name_nepali', 'type']),
            'selectedMunicipalities' => $municipalityIds,
            'comparisonData' => $comparisonData,
            'dateRange' => ['start' => $startDate, 'end' => $endDate],
        ]);
    }

    /**
     * Prepare chart data for municipality.
     */
    protected function prepareMunicipalityChartData($entries)
    {
        $byMonth = $entries->groupBy(function($entry) {
            return $entry->entry_date->format('Y-m');
        })->map(function($monthEntries) {
            return [
                'total_amount' => $monthEntries->sum('amount'),
                'count' => $monthEntries->count(),
            ];
        });
        
        return [
            'monthly' => $byMonth,
        ];
    }
}