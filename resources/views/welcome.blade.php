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
			<h1 class="page-title">Qiz</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid animi corporis dignissimos eaque maxime
				nobis non quas, totam veritatis! Animi.</p>
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
	<section class="row section-popular-quiz full-height" id="popular-quiz">
		<h3 class="center">Popular Quizzes</h3>
		<div class="bottom">&nbsp;</div>
		<div class="card col s3 quiz-cards">
			<div class="card-image">
				<img src="{{asset('images/Computer(9).jpg')}}" alt="">
				<h5 class="card-title">Quiz 01</h5>
			</div>
			<div class="card-content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, repellat?</p>
			</div>
			<div class="card-action">
				<button class="btn waves-effect">Take</button>
			</div>
		</div>
		<div class="card col s3 quiz-cards">
			<div class="card-image">
				<img src="{{asset('images/Linux(1).png')}}" alt="">
				<h5 class="card-title">Quiz 02</h5>
			</div>
			<div class="card-content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, voluptatum.</p>
			</div>
			<div class="card-action">
				<button class="btn waves-effect">Take</button>
			</div>
		</div>
		<div class="card col s3 quiz-cards">
			<div class="card-image">
				<img src="{{asset('images/Linux(2).jpg')}}" alt="">
				<h5 class="card-title">Quiz 03</h5>
			</div>
			<div class="card-content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, magni?</p>
			</div>
			<div class="card-action">
				<button class="btn waves-effect">Take</button>
			</div>
		</div>
	</section>
	<section class="row section-about full-height" id="about">
		<div class="col m6">
			<div class="card-panel valign-wrapper">
				<img class="responsive-img" src="{{asset('images/General (38).jpg')}}" alt="">
			</div>
		</div>
		<div class="col m6 section-about-text">
			<h3 class="center">About Qiz</h3>
			<p class="valign-wrapper">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aspernatur
				consequatur corporis cum delectus deserunt dicta dignissimos, doloremque enim ex id in, ipsam labore
				minima modi nulla quae quis, rerum sint vitae! Illo magnam molestiae, nostrum sunt tenetur vero.
				Illum.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, obcaecati?</p>
		</div>
	</section>
@endsection

@section('footer')
	@include('partials.footer')
@endsection