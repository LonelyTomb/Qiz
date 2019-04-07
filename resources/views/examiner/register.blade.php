@extends('master')
@section('title')
	Register(Examiner)
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection

@section('content')
	<div class="container">
		<form class="form card register-form" method="POST" action="{{ route('examiner.saveExaminer') }}">
			{{ csrf_field() }}
			<br>
			<h3 class="center form-title">
				Register As An Examiner
			</h3>
			<div class="card-content">
				<div class="row">
					<div class="input-field col s12">
						<input type="text" name="name" id="full-name" class="validate">
						<label for="first-name">Full Name:</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="email" name="email" id="email" class="validate">
						<label for="email">Email</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="password" name="password" id="password" class="validate">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
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
@endsection

@section('footer')
	@include('partials.footer')
@endsection