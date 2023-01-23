<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function admin(){
        $productCount = count(Product::all());
        $categoryCount = count(Category::all());
        $userCount = count(User::all());
        $orderCount = count(Order::all());
        return view('admin.index')->with(compact('productCount','categoryCount','userCount','orderCount'));
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users')->with('users', User::paginate(10));
    }

    public function viewOrders()
    {
        $orders = Order::all();
        return view('admin.orders.orders')->with('orders', Order::paginate(10));
    }

    public function viewOrderDetails($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $productsID = $orderDetail['products'];
        $products = [];
        foreach ($productsID as $pid) {
            array_push($products,Product::findorFail($pid));
        }
        return view('admin.orders.orderDetails')->with(compact('products','orderDetail'));
    }
}
