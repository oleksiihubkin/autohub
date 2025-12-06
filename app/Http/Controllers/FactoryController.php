<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFactoryRequest;
use App\Http\Requests\UpdateFactoryRequest;

class FactoryController extends Controller
{
    /**
     * Ensure the logged-in user is an admin.
     * Abort with 403 if not allowed.
     */
    private function ensureAdmin(): void
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Only admin can access this section.');
        }
    }


    /**
     * Display a paginated list of factories.
     * Loads car count using withCount().
     */
    public function index()
    {
        $factories = Factory::withCount('cars')->paginate(10);
        return view('factories.index', compact('factories'));
    }


    /**
     * Show the form for creating a new factory.
     * Only admins can access.
     */
    public function create()
    {
        $this->ensureAdmin();
        return view('factories.create');
    }


    /**
     * Store a new factory in the database.
     * Uses validated data from StoreFactoryRequest.
     */
    public function store(StoreFactoryRequest $request)
    {
        $this->ensureAdmin();
        Factory::create($request->validated());
        return redirect()->route('factories.index')->with('success', 'Factory created successfully!');
    }


    /**
     * Display a single factory with its cars.
     */
    public function show(Factory $factory)
    {
        // Load related cars
        $factory->load('cars');
        return view('factories.show', compact('factory'));
    }


    /**
     * Show the form for editing an existing factory.
     * Loads all dealers for selection.
     */
    public function edit(Factory $factory)
    {
        $this->ensureAdmin();

        // Dealers list for dropdown/multi-select
        $dealers = \App\Models\Dealer::all();

        return view('factories.edit', compact('factory', 'dealers'));
    }


    /**
     * Update factory data in the database.
     * Also updates factory–dealer pivot table (sync).
     */
    public function update(Request $request, Factory $factory)
    {
        $this->ensureAdmin();

        // Validate incoming fields
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'dealers'  => 'array', // array of dealer IDs
        ]);

        // Update main factory fields
        $factory->update([
            'name'     => $data['name'],
            'location' => $data['location'],
        ]);

        // Sync dealers relation (pivot table)
        $factory->dealers()->sync($request->input('dealers', []));

        return redirect()->route('factories.index')->with('success', 'Factory updated successfully!');
    }


    /**
     * Delete a factory from the database.
     */
    public function destroy(Factory $factory)
    {
        $this->ensureAdmin();
        $factory->delete();

        return redirect()->route('factories.index')->with('success', 'Factory deleted successfully!');
    }


    /**
     * Assign dealers to a factory (alternative route).
     * Uses 'dealer_ids' from the request.
     */
    public function assignDealers(Request $request, Factory $factory)
    {
        $factory->dealers()->sync($request->input('dealer_ids', []));
        return redirect()->route('factories.show', $factory)->with('success', 'Dealers assigned successfully!');
    }
}