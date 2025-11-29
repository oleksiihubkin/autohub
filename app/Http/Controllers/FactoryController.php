<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFactoryRequest;
use App\Http\Requests\UpdateFactoryRequest;


class FactoryController extends Controller
{
    private function ensureAdmin(): void
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Only admin can access this section.');
    }
}
    public function index()
{
    $factories = Factory::withCount('cars')->paginate(10);
    return view('factories.index', compact('factories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ensureAdmin();
        return view('factories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactoryRequest $request)
{
    $this->ensureAdmin();
    Factory::create($request->validated());
    return redirect()->route('factories.index')->with('success', 'Factory created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Factory $factory)
    {
        $factory->load('cars');
        return view('factories.show', compact('factory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factory $factory)
{
    $this->ensureAdmin();
    $dealers = \App\Models\Dealer::all();
    return view('factories.edit', compact('factory', 'dealers'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factory $factory)
{
    $this->ensureAdmin();
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'dealers' => 'array' // list of selected dealers
    ]);

    $factory->update([
            'name'     => $data['name'],
            'location' => $data['location'],
        ]);

    // Update factory-dealer relationship (pivot table)
    $factory->dealers()->sync($request->input('dealers', []));

    return redirect()->route('factories.index')->with('success', 'Factory updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory)
    {
        $this->ensureAdmin();
        $factory->delete();

        return redirect()->route('factories.index')->with('success', 'Factory deleted successfully!');
    }
    public function assignDealers(Request $request, Factory $factory)
{
    $factory->dealers()->sync($request->input('dealer_ids', []));
    return redirect()->route('factories.show', $factory)->with('success', 'Dealers assigned successfully!');
}

}
