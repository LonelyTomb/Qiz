@extends("master")
@section('title')
	View Saved Course Questions
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar');
		<div class="col m8">
			@if(count($questions) == 0)
				<h3>No Questions Available</h3>
			@else
				@foreach($questions as $question)
					<div class="card-panel">
						<h5 class="card-title">Question {{$loop->iteration}}</h5>
						<p class="left-align">
							Question: {{$question->question}}
						</p>
						<p>Answer: {{$question->answer->answer}}</p>
						<p>Keywords: {{$question->answer->keywords}}</p>
						<div><a href="delete/{{$question->id}}" class="btn waves-block materialize-red right">Delete</a>
						</div>
					</div>
					<br>
				@endforeach
			@endif
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

