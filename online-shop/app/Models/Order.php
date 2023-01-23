<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['order_detail_id'];

    public function orderDetailID(){
        return $this->belongsTo(OrderDetail::class);
    }

    public function calculateTotal($orderDetailID){
        $orderDetail = OrderDetail::findorFail($orderDetailID);
        $productAmount = count($orderDetail->products);
        $shipping = $productAmount * 10;
        $total = $orderDetail->subtotal + $shipping;
        return $total;
    }
}
