@extends('layouts.app')

@section('content')
<script src="login.js"></script>
<link href="login.css" rel="stylesheet" type="text/css">
<div class="wrapper">
  <form class="login" method="POST" action="{{ route('login') }}">
  @csrf
    <p class="title">Log in</p>
    <input input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus/>
    <i class="fa fa-user pt-2"></i>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password"/>
    <i class="fa fa-key pt-2"></i>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
             {{ __('Forgot Your Password?') }}
        </a>
        @endif
      <br>
    <a class="btn btn-link"  href="{{ route('register') }}">register</a>
    <button>
      <i class="spinner"></i>
      <span class="state">Log in</span>
    </button>
  </form>
  
</div>

@endsection

