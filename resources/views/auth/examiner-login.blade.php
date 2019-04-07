@extends('master')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h2>Examiner Login</h2>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('examiner.login.submit') }}">
                            {{ csrf_field() }}

                            <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-field col m6">
                                    <label for="email" class="">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-field col md-6">
                                    <label for="password">Password</label>

                                    <input id="password" type="password" class="" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m6">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col m8">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('examiner.password.request') }}">
                                        Forgot Your Password?
                                    </a>
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