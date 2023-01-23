@extends('layouts.admin')
@section('content')
    <h2>Show Category</h2>
    <label>Name</label>
    <h3>{{ $category->name }}</h3>
    <hr>

    <label>Image</label><br>
    <img src="{{ asset('storage/' . $category->image) }}" />
    <br/>
    <hr>
    <a class="btn btn-secondary" href="{{ url('admin/categories') }}">Back</a>
@endsection
