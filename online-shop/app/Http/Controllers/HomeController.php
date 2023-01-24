<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    function index()
    {
        
        return view('index')->with([
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    }

    function shop(Request $request)
    {
        $query = Product::query();

        $inputs = $request->all();

        if (isset($inputs['keywords'])) {
            $query = $query->where('name', 'like', "%" . $inputs['keywords'] . "%");
        }
        if (isset($inputs['color'])) {
            if (!in_array('-1', $inputs['color'])) {

                $query = $query->whereIn('color_id', $inputs['color']);
            }
        }
        if (isset($inputs['size'])) {
            if (!in_array('-1', $inputs['size'])) {
                $query = $query->whereIn('size_id', $inputs['size']);
            }
        }

        if ($request->has('category_id')) {
            $query = $query->where('category_id', $request->get('category_id'));
        }

        if ($request->has('price')) {
            if (!in_array('-1', $inputs['price'])) {
                $query = $query->where(function ($q) use ($inputs) {
                    foreach ($inputs['price'] as $price) {
                        $q = $q->orWhereBetween('price', [$price, $price + 100]);
                    }
                });
            }
        }

        /*SELECT * FROM Products WHERE con1 and con2 and (
        price between 0 and 100 or
        price between 100 and 200
        )
        */

        $query = $query->orderByDesc('created_at');
        $products = $query->paginate(9);


        return view('shop')->with([
            'products' => $products,
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }

    function add_product(Request $request)
    {
        if ($request->has('id')) {
            $map = Session::get('map', []);
            $ids = Session::get('ids', []);
            array_push($ids, $request->get('id'));
            if (array_key_exists($request->get('id'), $map))
                $map[$request->get('id')] += 1;
            else{
                array_push($map, $request->get('id'));
                $map[$request->get('id')] = 1;
            }
            Session::put('ids', $ids);
            Session::put('map', $map);
            return response()->json('Data addedd successfully');
        }
        return abort(404);
    }

    function add_likes(Request $request)
    {
        if ($request->has('id')) {
            $likes = Session::get('likes', []);
            array_push($likes, $request->get('id'));
            Session::put('likes', $likes);
            return response()->json('Data addedd successfully');
        }
        return abort(404);
    }

    //Checkout and Cart Functions

    function checkout($id){
        $orderDetailID = (int)$id;
        $productsMap = Session::get('map',[]);
        $products = [];
        $subTotal = 0;
        $shipping = 0;
        foreach(array_keys($productsMap) as $id){
            if(Product::find($id)){
                $product = Product::find($id);
                array_push($products, $product);
                $shipping += 10;
                $subTotal += ($product['price'] - $product['price'] * $product['discount']) * $productsMap[$product['id']];
            }
        }
        $total = $subTotal + $shipping;
        return view('checkout',compact('products','productsMap','subTotal','shipping','total','orderDetailID'));
    }

    function cart(){
        $productsMap = Session::get('map',[]);
        $products = [];
        $subTotal = 0;
        $shipping = 0;
        foreach(array_keys($productsMap) as $id){
            if(Product::find($id)){
                $product = Product::find($id);
                array_push($products, $product);
                $shipping += 10;
                $subTotal += ($product['price'] - $product['price'] * $product['discount']) * $productsMap[$product['id']];
            }
        }
        $total = $subTotal + $shipping;
        return view('cart',compact('products','productsMap','subTotal','shipping','total'));
    }

    function incQuantity(Request $request){
        if($request->has('id')){
            $map = Session::get('map', []);
            $ids = Session::get('ids', []);
            array_push($ids, $request->get('id'));
            $map[$request->get('id')] += 1;
            Session::put('ids', $ids);
            Session::put('map', $map);
            return response()->json("Product Quantity Inc");
        }
        return abort(404);
    }

    function decQuantity(Request $request){
        if($request->has('id')){
            $map = Session::get('map', []);
            $ids = Session::get('ids', []);
            if($map[$request->get('id')] > 1){
                $map[$request->get('id')] -= 1;
                array_pop($ids);
                Session::put('ids', $ids);
                Session::put('map', $map);
                return response()->json("Product Quantity Dec");
            }
        }
        return abort(404);
    }

    function remove(Request $request){
        if($request->has('id')){
            $map = Session::get('map', []);
            $ids = Session::get('ids', []);
            unset($map[$request->get('id')]);
            foreach(array_keys($ids,$request->get('id')) as $key){
                unset($ids[$key]);
            }
            Session::put('ids', $ids);
            Session::put('map', $map);
            return response()->json("Product Removed");
        }
        return abort(404);
    }
}