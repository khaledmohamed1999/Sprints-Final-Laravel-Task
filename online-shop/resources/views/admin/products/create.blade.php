@extends('layouts.admin')
@section('content')
    <h2>Add Product</h2>
    <form method="POST" action="{{ url('admin/products') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" />
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label>Description</label>
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
        <label>Price</label>
        <input class="form-control" name="price" type="number" value="{{ old('price') }}" />
        <label>Discount</label>
        <input class="form-control" name="discount" type="number" value="{{ old('discout') }}" step="0.01" />
        <label>Is Recent <input name="is_recent" type="checkbox" {{ old('is_recent') ? 'checked' : '' }} /></label>
        <br />
        <label>Is Featured <input name="is_featured" type="checkbox" {{ old('is_featured') ? 'checked' : '' }} /></label>
        <br />
        <label>Image</label>
        <input  name="image" type="file" value="{{ old('image') }}" />
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label>Category</label>
        <select class="form-control" name="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>

        <label>Color</label>
        <select class="form-control" name="color_id">
            <option>Select Color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id') == $color['id'] ? 'selected' : '' }}>{{ $color->name }}
                </option>
            @endforeach
        </select>

        <label>Size</label>
        <select class="form-control" name="size_id">
            <option>Select Size</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('size_id') == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
                </option>
            @endforeach
        </select>

        <label>Tags</label>
        <select class="form-control" name="tag_id">
            <option>Select Tag</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ old('tag_id') == $tag['id'] ? 'selected' : '' }}>{{ $tag->name }}
                </option>
            @endforeach
        </select>
        <br />
        <button class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
    </form>
@endsection
