@extends('master')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col m8 col moffset-2">
                <div class="panel panel-default">
                    <h2>Login</h2>

                    <div class="panel-body">
                        <form class="" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-field col m8">

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
                                <div class="input-field col m8">

                                    <label for="password" class="">Password</label>


                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col m6">
                                    <input type="checkbox" id="remember"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}>
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

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
    <br>
    <br>
@endsection

@section('footer')
    @include('partials.footer')
@endsection