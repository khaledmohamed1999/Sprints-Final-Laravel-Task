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
                <th>Order Number</th>
                <th>Person Who Placed Order</th>
                <th>Total</th>
                <th>Order Created At</th> 
                <th>Show Order Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['user_name'] }}</td>
                    <td>${{ $order['total'] }}</td>
                    <td>{{ $order['created_at'] }}</td>
                    <td><a class="btn btn-info" href="{{ url('admin/view-order/' . $order['order_detail_id']) }}">Show</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {!! $orders->links() !!}
@endsection
