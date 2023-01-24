<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function createOrderDetail(Request $request){
        $orderDetail = new OrderDetail;
        $products = array_keys($request->post()['products']);
        $quantities = array_keys($request->post()['quantities']);
        $orderDetail['products'] = $products;
        $orderDetail['quantities'] = $quantities;
        $orderDetail['subtotal'] = $orderDetail->calculateSubTotal($products,$quantities);
        $orderDetail['created_at'] = now();
        $orderDetail->save();
        return redirect('/checkout'.'/'.$orderDetail->id);
    }
}
