<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        // Показываем свежие отзывы, сразу подтягиваем автора и машину
        $reviews = Review::with(['user','car'])->latest()->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load(['user','car']);
        return view('reviews.show', compact('review'));
    }

    public function create()
    {
        // авторизация уже обеспечена middleware 'auth' в routes/web.php
        // подгружаем список машин для селекта
        $cars = Car::orderBy('id','desc')->get(['id','make','model']);
        return view('reviews.create', compact('cars'));
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $review = Review::create($data);

        return redirect()
            ->route('reviews.show', $review)
            ->with('success', 'Review created');
    }

    public function edit(Review $review)
    {
        // для CA1 можно полагаться на Blade @can, здесь без authorize()
        return view('reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());

        return redirect()
            ->route('reviews.show', $review)
            ->with('success', 'Review updated');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review deleted');
    }
}