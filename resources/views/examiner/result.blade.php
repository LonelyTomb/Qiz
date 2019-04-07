@extends("master")
@section('title')
	View Course Scripts
@endsection

@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m8">

			<div class="row quiz-container">
				<h4 class="center-align">Courses</h4>
				@foreach( $courses as $course)
					<div class="card quiz col s4">
						<div class="card-content">
							<h2 class="card-title quiz-title">{{$course->title}}</h2>
							<div class="card-action">
								<a href="results/{{$course->id}}" class="btn waves-block materialize-red">View
									Scripts</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

