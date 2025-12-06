<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    /**
     * Relationship: A dealer can collaborate with multiple factories.
     * Defined as a many-to-many relation using a pivot table.
     */
    public function factories()
    {
        return $this->belongsToMany(Factory::class);
    }
}
