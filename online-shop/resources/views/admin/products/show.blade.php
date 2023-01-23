@extends('layouts.admin')
@section('content')
    <h2>Show Product</h2>
    <label>Name</label>
    <h5>{{ $product->name }}</h5>
    <hr>
    
    <label>Price</label>
    <h5>{{ $product->price }}</h5>
    <hr>

    <label>Discount</label>
    <h5>{{ $product->discount }}</h5>
    <hr>
    
    <label>Description</label>
    <h5>{{ $product->description }}</h5>
    <hr>

    <label>Rating</label>
    <h5>{{ $product->rating }}</h5>
    <hr>

    <label>Rating count</label>
    <h5>{{ $product->rating_count }}</h5>
    <hr>
    
    <label>Category</label>
    <h5>{{ $product->category->name }}</h5>
    <hr>

    <label>Size</label>
    <h5>{{ $product->size->name }}</h5>
    <hr>
    
    <label>Color</label>
    <h5>{{ $product->color->name }}</h5>
    <hr>

    <label>Tag</label>
    <h5>{{ $product->tag->name }}</h5>
    <hr>
    
    <label>Image</label>
    <img style="width: 12%; height: 12%" src="{{ asset('storage/' . $product->image) }}" />
    <hr>
    <br/>
    <a class="btn btn-secondary" href="{{ url('admin/products') }}">Back</a>
@endsection
