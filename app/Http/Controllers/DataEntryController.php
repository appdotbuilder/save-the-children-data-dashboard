<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataEntryRequest;
use App\Models\Category;
use App\Models\DataEntry;
use App\Models\Municipality;
use App\Models\Sector;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DataEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        $query = DataEntry::with(['municipality:id,name,name_nepali', 'user:id,name'])
            ->orderBy('created_at', 'desc');
            
        // Apply filters based on user role
        if ($user->isPalikaUser() && $user->municipality_id) {
            $query->where('municipality_id', $user->municipality_id);
        } elseif (!$user->isSuperAdmin()) {
            $query->where('user_id', $user->id);
        }
        
        $entries = $query->paginate(20);
        
        return Inertia::render('data-entries/index', [
            'entries' => $entries,
            'userType' => $user->user_type,
            'userMunicipality' => $user->municipality,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        
        return Inertia::render('data-entries/create', [
            'tags' => Tag::active()->get(['id', 'budget_heading_english', 'budget_heading_nepali']),
            'sectors' => Sector::active()->get(['id', 'title', 'title_nepali']),
            'categories' => Category::active()->get(['id', 'title', 'title_nepali']),
            'municipalities' => $user->isSuperAdmin() 
                ? Municipality::active()->get(['id', 'name', 'name_nepali', 'type'])
                : ($user->municipality ? [$user->municipality] : []),
            'userMunicipality' => $user->municipality,
            'currentYear' => now()->year,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDataEntryRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        
        // Set municipality based on user role
        if ($user->isPalikaUser() && $user->municipality_id) {
            $data['municipality_id'] = $user->municipality_id;
        } elseif (!isset($data['municipality_id']) && $user->municipality_id) {
            $data['municipality_id'] = $user->municipality_id;
        }
        
        $data['user_id'] = $user->id;
        
        $entry = DataEntry::create($data);

        return redirect()->route('data-entries.show', $entry)
            ->with('success', 'Data entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataEntry $dataEntry)
    {
        $user = auth()->user();
        
        // Check permissions
        if (!$user->isSuperAdmin() && 
            !($user->isPalikaUser() && $user->municipality_id === $dataEntry->municipality_id) &&
            $dataEntry->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this data entry.');
        }
        
        $dataEntry->load(['municipality', 'user:id,name']);
        
        // Get related data
        $tags = collect([]);
        $sectors = collect([]);
        $categories = collect([]);
        
        if ($dataEntry->tag_ids) {
            $tags = Tag::whereIn('id', $dataEntry->tag_ids)->get(['id', 'budget_heading_english', 'budget_heading_nepali']);
        }
        
        if ($dataEntry->sector_ids) {
            $sectors = Sector::whereIn('id', $dataEntry->sector_ids)->get(['id', 'title', 'title_nepali']);
        }
        
        if ($dataEntry->category_ids) {
            $categories = Category::whereIn('id', $dataEntry->category_ids)->get(['id', 'title', 'title_nepali']);
        }
        
        return Inertia::render('data-entries/show', [
            'entry' => $dataEntry,
            'tags' => $tags,
            'sectors' => $sectors,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataEntry $dataEntry)
    {
        $user = auth()->user();
        
        // Check permissions
        if (!$user->isSuperAdmin() && 
            !($user->isPalikaUser() && $user->municipality_id === $dataEntry->municipality_id) &&
            $dataEntry->user_id !== $user->id) {
            abort(403, 'Unauthorized access to edit this data entry.');
        }
        
        $dataEntry->load(['municipality']);
        
        return Inertia::render('data-entries/edit', [
            'entry' => $dataEntry,
            'tags' => Tag::active()->get(['id', 'budget_heading_english', 'budget_heading_nepali']),
            'sectors' => Sector::active()->get(['id', 'title', 'title_nepali']),
            'categories' => Category::active()->get(['id', 'title', 'title_nepali']),
            'municipalities' => $user->isSuperAdmin() 
                ? Municipality::active()->get(['id', 'name', 'name_nepali', 'type'])
                : [$dataEntry->municipality],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDataEntryRequest $request, DataEntry $dataEntry)
    {
        $user = auth()->user();
        
        // Check permissions
        if (!$user->isSuperAdmin() && 
            !($user->isPalikaUser() && $user->municipality_id === $dataEntry->municipality_id) &&
            $dataEntry->user_id !== $user->id) {
            abort(403, 'Unauthorized access to update this data entry.');
        }
        
        $data = $request->validated();
        
        // Maintain original municipality if user is not super admin
        if (!$user->isSuperAdmin()) {
            $data['municipality_id'] = $dataEntry->municipality_id;
        }
        
        $dataEntry->update($data);

        return redirect()->route('data-entries.show', $dataEntry)
            ->with('success', 'Data entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataEntry $dataEntry)
    {
        $user = auth()->user();
        
        // Check permissions
        if (!$user->isSuperAdmin() && 
            !($user->isPalikaUser() && $user->municipality_id === $dataEntry->municipality_id) &&
            $dataEntry->user_id !== $user->id) {
            abort(403, 'Unauthorized access to delete this data entry.');
        }
        
        $dataEntry->delete();

        return redirect()->route('data-entries.index')
            ->with('success', 'Data entry deleted successfully.');
    }
}