@extends("master")

@section('title')
    Home
@endsection

@section('style')
    <style>

    </style>
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
    <section class="row section-home full-height" id="home">
        <div class="col s10 m4 offset-m2">
            <h1 class="page-title">Essay Test Assessor</h1>
            <p></p>
            <div class="row center">
                <p>Login As</p>
                <a class="btn btn-large left" href="{{route('examiner.login')}}">Examiner</a>
                <a class="btn btn-large right" href="{{route('logIn')}}">Student</a>
                <p class="clearfix"></p>
                <br>
                <p><a class="" href="{{route('examiner.register')}}">Register</a> as an examiner</p>
            </div>
        </div>
        <div class="col s10 m4 offset-m1">
            <form class="form card register-form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <h4 class="card-title center form-title">
                    Register
                </h4>
                <div class="card-content">
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="name" id="full-name" class="validate">
                                <label for="first-name">Full Name:</label>
                            </div>

                        </div>
                        <div class="input-field col s12">
                            <input type="email" name="email" id="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="password" name="password" id="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="password" name="password_confirmation" id="confirm_password" class="validate">
                            <label for="confirm_password">Confirm Password</label>
                        </div>
                    </div>
                    <div class="card-action center">
                        <button class="btn waves-ripple waves-effect register-button" type="submit">Enter Now</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="row section-about full-height" id="about">
        <div class="col m6">
            <div class="card-panel valign-wrapper">
                <img class="responsive-img" src="{{asset('images/General (38).jpg')}}" alt="">
            </div>
        </div>
        <div class="col m6 section-about-text">
            <h3 class="center">About ETA</h3>
            <p class="valign-wrapper">Essay Test Assessor is an app developed to mark ad give scores of user essays</p>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection