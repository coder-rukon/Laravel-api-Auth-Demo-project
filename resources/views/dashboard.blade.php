@extends('layouts.master')
@section('content')
<div class="container">
    <div class="jumbotron mt-3">
        <h1 class="mb-2 text-center">{{ __('dashboard.title') }}</h1>
        <p><strong>{{ __('dashboard.userEmail') }} : </strong>{{$user->email}}</p>
        <p><strong>{{ __('dashboard.userLocal') }} : </strong>{{$user->locale}}</p>
        <div class="text-center mt-5">
            <a class="btn btn-danger btn-lg" href="{{ url()->route('logout')}}">{{ __('global.logout') }}</a>
        </div>
            
    </div>
</div>
@endsection