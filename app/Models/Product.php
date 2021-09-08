<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'description',
        'slug',
        'price',
        'quantity',
        'featured',
        'user_id',
    ];

    public function getFeaturedAttribute($featured){
        return asset($featured);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
