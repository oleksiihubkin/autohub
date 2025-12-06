<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'color',
        'price',
        'factory_id'
    ];

    /**
     * Relationship: A car belongs to a single factory.
     */
    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    /**
     * Relationship: A car can have many reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
