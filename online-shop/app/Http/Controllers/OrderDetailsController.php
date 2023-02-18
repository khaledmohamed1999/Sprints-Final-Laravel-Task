<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function createOrderDetail(Request $request){
        $orderDetail = new OrderDetail;
        $productArray = array_keys($request->post()['products']);
        $quantities = array();
        $products = array();
        foreach ($productArray as $product) {
            array_push($products,explode(",",$product)[0]);
            array_push($quantities,explode(",",$product)[1]);
        }
        $orderDetail['products'] = $products;
        $orderDetail['quantities'] = $quantities;
        $orderDetail['subtotal'] = $orderDetail->calculateSubTotal($products,$quantities);
        $orderDetail['created_at'] = now();
        $orderDetail->save();
        return redirect('/checkout'.'/'.$orderDetail->id);
    }
}
