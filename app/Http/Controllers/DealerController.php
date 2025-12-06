<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDealerRequest;
use App\Http\Requests\UpdateDealerRequest;

/**
 * Controller responsible for handling CRUD operations for Dealers.
 * Each action is supported by dedicated Form Request validation.
 */
class DealerController extends Controller
{
    /**
     * Display a list of all dealers.
     * No pagination is required because the dataset is expected to be small.
     */
    public function index()
    {
        $dealers = Dealer::all();
        return view('dealers.index', compact('dealers'));
    }

    /**
     * Show the form for creating a new dealer.
     */
    public function create()
    {
        return view('dealers.create');
    }

    /**
     * Store a newly created dealer in the database.
     * Uses StoreDealerRequest for validation.
     */
    public function store(StoreDealerRequest $request)
    {
        Dealer::create($request->validated());

        return redirect()
            ->route('dealers.index')
            ->with('success', 'Dealer added successfully.');
    }

    /**
     * Display a single dealer.
     * Loads the factories connected to this dealer (many-to-many relationship).
     */
    public function show(Dealer $dealer)
    {
        $dealer->load('factories'); // eager load related factories
        return view('dealers.show', compact('dealer'));
    }

    /**
     * Show the form for editing an existing dealer.
     */
    public function edit(Dealer $dealer)
    {
        return view('dealers.edit', compact('dealer'));
    }

    /**
     * Update an existing dealer in the database.
     * Uses UpdateDealerRequest for validation.
     */
    public function update(UpdateDealerRequest $request, Dealer $dealer)
    {
        $dealer->update($request->validated());

        return redirect()
            ->route('dealers.index')
            ->with('success', 'Dealer updated successfully.');
    }

    /**
     * Remove the dealer from the database.
     */
    public function destroy(Dealer $dealer)
    {
        $dealer->delete();

        return redirect()
            ->route('dealers.index')
            ->with('success', 'Dealer deleted successfully.');
    }
}
