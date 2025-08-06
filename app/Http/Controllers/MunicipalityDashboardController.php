<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DataEntry;
use App\Models\Municipality;
use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MunicipalityDashboardController extends Controller
{
    /**
     * Display single municipality dashboard.
     */
    public function index(Request $request, Municipality $municipality = null)
    {
        if (!$municipality) {
            // Redirect to select a municipality
            return Inertia::render('municipality-selector', [
                'municipalities' => Municipality::active()->get(['id', 'name', 'name_nepali', 'type']),
            ]);
        }

        $startDate = $request->get('start_date', now()->startOfYear()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfYear()->format('Y-m-d'));
        
        $entries = DataEntry::where('municipality_id', $municipality->id)
            ->whereBetween('entry_date', [$startDate, $endDate])
            ->with(['user:id,name'])
            ->get();
            
        $chartData = $this->prepareMunicipalityChartData($entries);
        
        return Inertia::render('municipality-dashboard', [
            'municipality' => $municipality,
            'entries' => $entries,
            'chartData' => $chartData,
            'dateRange' => ['start' => $startDate, 'end' => $endDate],
            'totalAmount' => $entries->sum('amount'),
            'totalEntries' => $entries->count(),
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
            'by_category' => $this->getDataByCategories($entries),
            'by_sector' => $this->getDataBySectors($entries),
        ];
    }

    /**
     * Get data grouped by categories.
     */
    protected function getDataByCategories($entries)
    {
        $categories = Category::active()->get(['id', 'title', 'title_nepali']);
        
        return $categories->map(function($category) use ($entries) {
            $categoryEntries = $entries->filter(function($entry) use ($category) {
                return in_array($category->id, $entry->category_ids ?? []);
            });
            
            return [
                'category' => $category,
                'total_amount' => $categoryEntries->sum('amount'),
                'count' => $categoryEntries->count(),
            ];
        });
    }

    /**
     * Get data grouped by sectors.
     */
    protected function getDataBySectors($entries)
    {
        $sectors = Sector::active()->get(['id', 'title', 'title_nepali']);
        
        return $sectors->map(function($sector) use ($entries) {
            $sectorEntries = $entries->filter(function($entry) use ($sector) {
                return in_array($sector->id, $entry->sector_ids ?? []);
            });
            
            return [
                'sector' => $sector,
                'total_amount' => $sectorEntries->sum('amount'),
                'count' => $sectorEntries->count(),
            ];
        });
    }
}