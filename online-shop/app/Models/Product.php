<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public static $rules = [
        'name' => 'required',
        'size_id' => 'required',
        'color_id' => 'required',
        'category_id' => 'required',
        'tag_id' => 'required'
    ];
    protected $guarded = ['rating', 'rating_count'];

    public function getPrice()
    {
        return $this->price - $this->price * $this->discount;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}