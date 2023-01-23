@extends('layouts.admin')
@section('content')
    <h2>Edit Product</h2>
    <form method="POST" action="{{ url('admin/products/'.$product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name', $product->name) }}" />
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label>Description</label>
        <textarea class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
        <label>Price</label>
        <input class="form-control" name="price" type="number" value="{{ old('price', $product->price) }}" />
        <label>Discount</label>
        <input class="form-control" name="discount" type="number" value="{{ old('discount', $product->discount) }}" step="0.01" />
        <label>Is Recent <input name="is_recent" type="checkbox" {{ old('is_recent', $product->is_recent) ? 'checked' : '' }} /></label>
        <br />
        <label>Is Featured <input name="is_featured" type="checkbox" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} /></label>
        <br />
        <label>Image</label>
        <input  name="image" type="file" value="{{ old('image', $product->image) }}" />
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label>Category</label>
        <select class="form-control" name="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category['id'] ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>

        <label>Color</label>
        <select class="form-control" name="color_id">
            <option>Select Color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id', $product->color_id) == $color['id'] ? 'selected' : '' }}>{{ $color->name }}
                </option>
            @endforeach
        </select>

        <label>Size</label>
        <select class="form-control" name="size_id">
            <option>Select Size</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('size_id', $product->size_id) == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
                </option>
            @endforeach
        </select>

        <label>Tags</label>
        <select class="form-control" name="tag_id">
            <option>Select Tag</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ old('tag_id', $product->tag_id) == $tag['id'] ? 'selected' : '' }}>{{ $tag->name }}
                </option>
            @endforeach
        </select>
        <br />
        <button class="btn btn-primary">Edit</button>
        <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
    </form>
@endsection
