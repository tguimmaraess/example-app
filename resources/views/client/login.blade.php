@extends('layouts.client.authentication')

@section('title', 'Page Title')

@section('content') 
  <div class="w-50 mx-auto mt-4">

    @if (Session::has('message'))
      <div class="alert mt-2 mb-2 alert-{{Session::get('alert')}}" role="alert">
      {{Session::get('message')}}
      </div>
    @endif
    
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="log-in" method="post">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating mt-2">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div> 
      @csrf
      <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Sign in</button>
    </form>
  </div> 
@endsection
