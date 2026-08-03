@extends('layout.backend')
@section('title', 'ORDERS LIST')
@section('content')
<div class="table-title">
    <div class="row">
        <div class="col-sm-5">
            <h2>@yield('title')</b></h2>
        </div>

    </div>
</div>
<table class="table-bordered table-striped" id="orderId">
    <thead class="thead">
        <tr>
            <th width="50">NO.</th>
            <th width="130">USERNAME</th>
            <th width="200">Email</th>
            <th width="250">ORDER ID</th>
            <th width="180">ORDER ITEMS</th>
            <th width="150">TOTAL</th>
            <th width="150">Status</th>
            <th colspan="3" width="300">OPTIONS</th>
        </tr>
    </thead>
    <tbody id="tbl" class="text-center">
        @foreach ($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->user->email }}</td>
            <td>{{ $order->id}}</td>
            <td style="text-align: left;">@foreach ($order->orderItems as $item)
                    {{$loop->iteration}} {{ $item->product->name}} x {{$item->quantity}} = ${{ $item->product->price * $item->quantity}} <br>
                @endforeach
            </td>
            <td>${{ $order->amount }}</td>
            <td>@if($order->status)
                    confirmed
                @else
                    pendding
                @endif
            </td>
            <div class="orderOption">
                <td>
                    <form action="{{ route('admin.approve', $order->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button class="text-primary">Confirm</button>
                    </form>
                </td>

                <td>
                    <form action="{{ route('admin.reject', $order->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button class="text-danger">Reject</button>
                    </form>
                </td>
            </div>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection