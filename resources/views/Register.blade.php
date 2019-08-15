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
                @if(session('registration_success'))
                    <div class="alert alert-success">
                        <p>{{session('registration_success') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('registRequest') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email_address">{{ __('global.emailAddress') }}</label>
                        <input name="email" type="email" class="form-control" id="email_address"  placeholder="{{ __('global.emailAddress') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('global.password') }}</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('global.password') }}">
                    </div>
                    <div class="form-group">
                        <label for="passConfirm">{{ __('global.confirmPassword') }}</label>
                        <input name="password_confirmation" type="password" class="form-control" id="passConfirm" placeholder="{{ __('global.confirmPassword') }}">
                    </div>
                    <div class="form-check">
                        <input name="tc" type="checkbox" class="form-check-input" id="terms_condition">
                        <label class="form-check-label" for="terms_condition">{{ __('global.tct') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('global.register') }}</button>
                </form>
        </div>
    </div>
@endsection