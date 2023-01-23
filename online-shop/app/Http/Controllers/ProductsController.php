<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }

    public function index()
    {
        return view('admin.products.index')->with('products', Product::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        return view('admin.products.create')->with([
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(Product::$rules);
        
        $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
        $product = new Product;
        $product->fill($request->post());
        $product['image'] = $imageUrl;
        $product['rating'] = 0;
        $product['rating_count'] = 0;
        $product['is_recent'] = $request['is_recent'] ? 1 : 0;
        $product['is_featured'] = $request['is_featured'] ? 1 : 0;
        $product->save();
        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate(Product::$rules);
        $product->fill($request->post());
        if($request->file('image')){
            $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
            $product['image'] = $imageUrl;
        }
        $product['is_recent'] = $request['is_recent'] ? 1 : 0;
        $product['is_featured'] = $request['is_featured'] ? 1 : 0;
        $product->save();
        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id);
        Product::destroy($id);
        return redirect()->route('admin.products')->with('success', 'Record has been deleted successfully!');
    }

    //Product details function start here

    public function showDetail($id)
    {
        $product = Product::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $productTag = Tag::find($product->tag_id)->name;
        $reviews = DB::table('reviews')->where('product_id', '=', $id)->get();
        return view('productDetail', compact('product', 'colors', 'sizes', 'productTag', 'reviews'));
    }


    public function detailReview(Request $request, $id){
        $product = Product::findOrFail($id);

        //Creating the review
        $request->validate(Review::$rules);
        $review = new Review;
        $review->fill($request->post());
        $review['reviewer'] = Auth::user()->name;
        $review['product_id'] = $id;
        $review['created_at'] = now();

        //Updating review numbers
        $product->rating = ($product->rating * $product->rating_count + $request->rating) / ($product->rating_count + 1);
        $product->rating_count += 1;

        //Saving
        $product->save();
        $review->save();
        return redirect()->back();
    }
}