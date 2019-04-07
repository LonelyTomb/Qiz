@extends('master')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col m8">
                <div class="panel panel-default">
                    <h2 class="panel-heading">Examiner Reset Password</h2>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('examiner.password.request') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-field col m6">
                                    <label for="email" class="">E-Mail Address</label>
                                    <input id="email" type="email" class="" name="email"
                                           value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col m6">
                                    <label for="password" class="">Password</label>


                                    <input id="password" type="password" class="" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="input-field col m6">
                                    <label for="password-confirm" class="">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col m12">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection