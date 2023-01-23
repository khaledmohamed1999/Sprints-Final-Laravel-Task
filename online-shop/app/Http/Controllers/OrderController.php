<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder($orderDetailID){
        $order = new Order;
        $order['order_detail_id'] = $orderDetailID;
        $order['user_name'] = Auth::user()->name;
        $order['total'] = $order->calculateTotal($orderDetailID);
        $order->save();
    }
}
