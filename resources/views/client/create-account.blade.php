@extends('layouts.client.authentication')

@section('title', 'Page Title')

@section('content') 
  <div class="w-50 mx-auto mt-4">

    @if (Session::has('message'))
      <div class="alert mt-2 mb-2 alert-danger" role="alert">
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

    <form action="create" method="post">
      <h1 class="h3 mb-3 fw-normal">Create your account</h1>
      <div class="form-floating">
        <input required type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating mt-2">
        <input required type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div> 
      <div class="form-floating mt-2">
        <input required type="text" name="name" class="form-control" id="name" placeholder="John Doe">
        <label for="name">Name</label>
      </div> 
      <div class="mt-2">
        <textarea required name="address" class="form-control" id="name" placeholder="Full address including state and country"></textarea>
      </div> 
      <div class="form-floating mt-2">
        <input required type="text" name="phone" class="form-control" id="name" placeholder="31 1312123">
        <label for="phone">Phone</label>
      </div> 
      @csrf
      <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Create Account</button>
    </form>
  </div> 
@endsection
