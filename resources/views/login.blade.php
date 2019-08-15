@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="jumbotron mt-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(session('messages'))
                        <div class="alert alert-danger">
                            @foreach (session('messages') as $message)
                                <p>This is user {{ $message[0] }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('loginRequest') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email_address">{{ __('global.emailAddress') }}</label>
                            <input name="email" type="email" class="form-control" id="email_address"  placeholder="{{ __('global.emailAddress') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('global.password') }}</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('global.password') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('global.login') }}</button>
                    </form>
        </div>
    </div>
@endsection