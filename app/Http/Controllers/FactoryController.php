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
     * Display a listing of the resource.
     */
    public function index()
    {
    $factories = Factory::with('cars')->get();
    return view('factories.index', compact('factories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('factories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactoryRequest $request)
{
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
        return view('factories.edit', compact('factory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactoryRequest $request, Factory $factory)
{
    $factory->update($request->validated());
    return redirect()->route('factories.index')->with('success', 'Factory updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory)
    {
        $factory->delete();

        return redirect()->route('factories.index')->with('success', 'Factory deleted successfully!');
    }
    public function assignDealers(Request $request, Factory $factory)
{
    $factory->dealers()->sync($request->input('dealer_ids', []));
    return redirect()->route('factories.show', $factory)->with('success', 'Dealers assigned successfully!');
}

}
