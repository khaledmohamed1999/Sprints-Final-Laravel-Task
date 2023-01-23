<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public $timestamps = false;
    public static $rules = [
        'rating' => 'required',
        'review_message' => 'required'
    ];

    protected $guarded = ['user_id'];

    public function userID(){
        return $this->belongsTo(User::class);
    }

    public function productID(){
        return $this->belongsTo(Product::class);
    }
}
