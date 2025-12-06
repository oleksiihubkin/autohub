<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a paginated list of recent reviews.
     * Loads related user and car for each review.
     */
    public function index()
    {
        // Fetch newest reviews with eager-loaded relations
        $reviews = Review::with(['user', 'car'])->latest()->paginate(10);

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Display a single review.
     */
    public function show(Review $review)
    {
        // Load user and car relation for detailed view
        $review->load(['user', 'car']);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for creating a new review.
     * User authentication is handled by the 'auth' middleware in web.php.
     */
    public function create()
    {
        // Load cars for dropdown selection
        $cars = Car::orderBy('id', 'desc')->get(['id', 'make', 'model']);

        return view('reviews.create', compact('cars'));
    }

    /**
     * Store a new review in the database.
     * Uses validated request data.
     */
    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id(); // assign the review author

        $review = Review::create($data);

        return redirect()
            ->route('reviews.show', $review)
            ->with('success', 'Review created');
    }

    /**
     * Show the form for editing an existing review.
     * Permission is handled in Blade with @can().
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update an existing review.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        // Apply validated changes
        $review->update($request->validated());

        return redirect()
            ->route('reviews.show', $review)
            ->with('success', 'Review updated');
    }

    /**
     * Delete the given review.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review deleted');
    }
}