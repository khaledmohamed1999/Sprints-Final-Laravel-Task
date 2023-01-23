<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static $rules = [
        'name' => 'required',
        'image' => 'required|mimes:jpg,png,bmp,jpeg|max:2048'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}