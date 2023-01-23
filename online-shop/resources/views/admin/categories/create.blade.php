@extends('layouts.admin')
@section('content')
    <h2>Add Category</h2>
    <form method="POST" action="{{ url('admin/categories') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" />
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input name="image" type="file" /><br />
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ url('admin/categories') }}">Cancel</a>
    </form>
@endsection
