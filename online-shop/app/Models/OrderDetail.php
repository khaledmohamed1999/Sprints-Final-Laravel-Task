<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static $rules = [
        'products' => 'required',
        'quantities' => 'required',
    ];

    protected $guarded = ['subtotal'];

    protected $casts = [
        'products' => AsArrayObject::class,
        'quantities' => AsArrayObject::class
    ];

    public function calculateSubTotal($products,$quantities){
        $subtotal = 0;
        for ($i=0; $i < count($products); $i++) {
            $product = Product::findorFail($products[$i]);
            $subtotal += (($product->price - ($product->price * $product->discount)) * $quantities[$i]);
        }
        return $subtotal;
    }
}
