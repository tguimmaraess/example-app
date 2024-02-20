@extends('layouts.client.default', ['page' => 'dashboard'])

@section('title', 'Page Title')

@section('content') 
  <div class="row">
    <div class="col-lg-4 mt-2">
      <div class="card">
        <div class="card-body bg-primary text-white">
          <p class="fs-1">{{$ordersTotal}}</p>
          <p class="card-text">Total Orders</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-2">
      <div class="card">
        <div class="card-body bg-success text-white">
          <p class="fs-1">{{$finishedOrdersTotal}}</p>
          <p class="card-text">Finished Orders</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-2">
      <div class="card">
        <div class="card-body bg-danger text-white">
          <p class="fs-1">{{$canceledOrdersTotal}}</p>
          <p class="card-text">Canceled Orders</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-2">
      <div class="card">
        <div class="card-body bg-warning text-dark">
          <p class="fs-1">{{$pendingOrdersTotal}}</p>
          <p class="card-text">Pending Orders</p>
        </div>
      </div>
    </div>
  </div>
@endsection
