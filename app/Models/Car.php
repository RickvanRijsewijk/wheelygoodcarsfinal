<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_plate',
        'brand',
        'model',
        'seats',
        'doors',
        'weight',
        'price',
        'mileage',
        'production_year',
        'color',
        'status',
        'sold_at',
        'image',
        'views',
        'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'car_tag', 'car_id', 'tag_id');
    }
}

