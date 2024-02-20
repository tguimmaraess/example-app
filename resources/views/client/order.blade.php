
@extends('layouts.client.default', ['page' => 'order'])

@section('title', 'Orders')

@section('content') 

<div class="card">
  <div class="card-header">
    Order #{{$order['id']}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Ordered on {{$order['created_at']}}</h5>
      <p class="card-text">Status: 
        <b class="
          @if($order['status'] == 'pending') text-warning @endif
          @if($order['status'] == 'canceled') text-danger @endif
          @if($order['status'] == 'finished') text-success @endif"
        >          
        {{$order['status']}}
      </b>
    </p>
    @if ($order['status'] == 'canceled')
      <a href="{{url('reset-order-status/'.$order['id'])}}" class="btn btn-primary">Undo cancellation</a>
    @endif
  </div>
</div>
@endsection