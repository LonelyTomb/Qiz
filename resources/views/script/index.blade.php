@extends("master")
@section('title')
	View All Script
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('student.sidebar')
		<div class="col m8">
			<div class="row">
				@foreach($scripts as $script)
					<div class="card quiz col s4">
						<h5>Quiz {{$loop->count}}</h5>
						<div class="card-content">
							<h4 class="" style="text-transform: capitalize">{{ $script->course->title }}</h4>
							<div>
								<p>Score: {{$script->quiz->result}}%</p>
							</div>
							<div>
								<a href="script/show/{{$script->quiz->id}}">View Script</a>
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