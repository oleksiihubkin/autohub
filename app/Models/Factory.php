<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function dealers()
{
    return $this->belongsToMany(Dealer::class);
}

}
