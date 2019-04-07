@extends("master")
@section('title')
	Check Student Scripts
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m8">
			@foreach($quizzes as $quiz)
				<div class="card quiz col s4">
					<h5>Quiz No:{{$loop->count}}</h5>
					<hr>
					<div class="card-content">
						<h5 class="">Quiz Taker: {{ $quiz->user->name }}</h5>
						<p class="">Score: {{ number_format($quiz->quiz->result,2,'.',',') }}%</p>
						<p>Total time taken: {{$quiz->quiz->speed}}}</p>
						<div>
							<a href="../viewScript/{{$quiz->quiz_id}}" class="btn ">View Script</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

