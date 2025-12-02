<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['make','model','year','color','price','factory_id'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}