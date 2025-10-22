<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDealerRequest;
use App\Http\Requests\UpdateDealerRequest;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dealers = Dealer::all();
        return view('dealers.index', compact('dealers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dealers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDealerRequest $request)
{
    Dealer::create($request->validated());
    return redirect()->route('dealers.index')->with('success', 'Dealer added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Dealer $dealer)
    {
        $dealer->load('factories');
        return view('dealers.show', compact('dealer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dealer $dealer)
    {
        return view('dealers.edit', compact('dealer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealerRequest $request, Dealer $dealer)
{
    $dealer->update($request->validated());

    return redirect()->route('dealers.index')->with('success', 'Dealer updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dealer $dealer)
    {
        $dealer->delete();
        return redirect()->route('dealers.index')->with('success', 'Dealer deleted successfully.');
    }
}

