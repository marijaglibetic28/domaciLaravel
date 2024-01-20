<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'rating',
        'category_id',
        'user_id',
        'city'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cityTo()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
