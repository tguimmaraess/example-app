
@extends('layouts.client.default', ['page' => 'orders'])

@section('title', 'Orders')

@section('content') 
<h1>Your orders</h1>

@if (Session::has('message'))
  <div class="alert mt-2 mb-2 alert-{{Session::get('alert')}}" role="alert">
    {{Session::get('message')}}
  </div>
@endif		

<div class="d-flex flex-wrap">
  <div class="col-12 col-sm-7 col-lg-4">
    <form role="search" class="me-3" action="search-orders">
      <div class="d-flex w-50 mt-5">
        <input type="text" name="search" placeholder="Search orders by id" />
        <button class="btn btn-primary ms-2">Search</button>
      </div>
    </form>
  </div>
  <div class="col-12 col-sm-4 col-lg-6">
    <form role="search" action="search-orders">
      <div class="d-flex mt-5">
        <select class="form-control w-50" name="search">
        <option value="">All</option>
          <option value="pending" @if(request()->query('search') == 'pending') selected @endif)>Pending</option>
          <option value="canceled"  @if(request()->query('search') == 'canceled') selected @endif>Canceled</option>
          <option value="finished"  @if(request()->query('search') == 'finished') selected @endif>Finished</option>
        </select>
        <button class="btn btn-primary ms-2">Filter</button>
      </div>
    </form>
  </div>
</div>

<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Created at</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
      <tr>
        <td>{{$order['id']}}</td>
        <td>
          <span class="badge 
            @if($order['status'] == 'pending') bg-warning @endif 
            @if($order['status'] == 'canceled') bg-danger @endif 
            @if($order['status'] == 'finished') bg-success @endif">
            {{$order['status']}}
          </span>
        </td>
        <td>{{$order['created_at']}}</td>
        <td>
          @if ($order['status'] !== 'canceled')
            <a href="{{url('cancel-order/'.$order['id'])}}" class="btn btn-danger">Cancel</a>
          @endif
          <a href="{{url('order/'.$order['id'])}}" class="btn btn-primary">View</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{$orders->links()}}

@endsection