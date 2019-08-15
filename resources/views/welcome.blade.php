@extends('layouts.master')
@section('content')

<div class="container">
    @if (Route::has('login'))
        
    @endif
  <div class="jumbotron mt-3">
    <h1 class="text-center mb-2">@lang('welcome.welcome')</h1>
    <div class="text-center mt-2">
    @auth
      <a class="btn btn-danger btn-lg" href="{{ url()->route('logout')}}">{{ __('global.logout') }}</a>
    @else
        <a class="btn btn-success" href="{{ route('login') }}">{{ __('global.login') }}</a>
        <a class="btn btn-info" href="{{ route('registerUrl') }}">{{ __('global.register') }}</a>
    @endauth
    </div>
  </div>
</div>
@endsection