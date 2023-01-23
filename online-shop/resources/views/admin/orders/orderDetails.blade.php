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
                <th>Product</th>
                <th>Quantity</th>
                <th>Total of Product</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($products); $i++)
                <tr>
                    <td><a href="{{ url('admin/products/' . $products[$i]['id']) }}">{{ $products[$i]['name'] }}</a></td>
                    <td>{{ $orderDetail['quantities'][$i] }}</td>
                    <td>
                        {{ ($products[$i]['price'] - $products[$i]['price'] * $products[$i]['discount']) * $orderDetail['quantities'][$i] }}
                    </td>
                    <td>{{ $orderDetail['subtotal'] }}</td>
                </tr>
            @endfor

        </tbody>
    </table>
@endsection
