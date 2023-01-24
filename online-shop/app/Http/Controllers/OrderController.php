<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder($id){
        $orderdetail = OrderDetail::findOrFail($id);
        $order = new Order;
        $order['order_detail_id'] = $id;
        $order['user_name'] = Auth::user()->name;
        $order['total'] = $order->calculateTotal($id);
        session()->forget(['ids', 'map']);
        $order->save();
        return redirect('/cart');
    }
}
