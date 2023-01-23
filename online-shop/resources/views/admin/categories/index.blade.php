@extends('layouts.admin')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>
                        <img style="width: 12%; height: 12%;" src="{{asset('storage/'.$category->image)}}" />
                    </td>
                    <td>{{ $category['name'] }}</td>
                    <td><a class="btn btn-info" href="{{ url('admin/categories/' . $category['id']) }}">Show</a></td>
                    <td><a class="btn btn-warning" href="{{ url('admin/categories/' . $category['id'] . '/edit') }}">Edit</a></td>
                    <td>
                        <form action="{{ url('admin/categories/' . $category['id']) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a class="btn btn-success" href="{{ url('admin/categories/create') }}">Add</a>
    {!! $categories->links() !!}
@endsection
