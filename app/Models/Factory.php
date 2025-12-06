<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    /**
     * Mass-assignable attributes for the Factory model.
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Relationship: A factory can produce many cars.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    /**
     * Relationship: A factory may work with multiple dealers.
     * Many-to-many relation via the pivot table factory_dealer.
     */
    public function dealers()
    {
        return $this->belongsToMany(Dealer::class);
    }
}
