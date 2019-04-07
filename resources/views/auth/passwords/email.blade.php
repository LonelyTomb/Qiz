@extends('master')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col m8 offset-m2">
                <div class="panel panel-default">
                    <h3>Reset Password</h3>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-field col m8">
                                    <label for="email" class=" control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="validate" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group col s12">
                                    <button type="submit" class="btn waves-block">
                                        Send Password Reset Link
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
