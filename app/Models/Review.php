<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Mass-assignable fields for the Review model.
     */
    protected $fillable = [
        'user_id',
        'car_id',
        'rating',
        'comment',
    ];

    /**
     * Relationship: A review belongs to a single user (the author).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A review belongs to a single car.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
