@extends("master")
@section('title')
	{{$course->title}}
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<form class="form-horizontal" method="POST" action="{{ route('quiz.store') }}" id="form">
		{{ csrf_field() }}
		<input type="hidden" name="time" value={{$course->time * 60}}>
		<div class="row">
			@include('student.sidebar')
			<div class="col m8">
				<div class="row">
					<br>
					<div class="your-clock @if(!$timer_display) hide @endif"></div>
				</div>
				@if(count($questions) > 0)
					<div class="row quiz-container">
						<?php $i = 1; ?>
						<input type="hidden" name="course" value="{{ $id }}">
						@foreach($questions as $question)
							<div class="card-panel col s12">
								<p class="card-title quiz-title">{{ $i }}: {{ $question->question }}</p>

								<input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">

								<div class="row">
									<div class="input-field">
                                    <textarea class="materialize-textarea" name="answers[{{ $question->id }}]"
                                              id="answers[{{ $question->id }}]" cols="30" rows="10"> </textarea>
										<label for="answers[{{ $question->id }}]">Answer</label>
									</div>
								</div>
							</div>
							<?php $i++; ?>
						@endforeach
					</div>
					<button type="submit" class="btn btn-primary">
						Submit
					</button>
				@else
					<h3>No Questions on this quiz</h3>
				@endif
			</div>
		</div>
	</form>
@endsection
@section('footer')
	@include('partials.footer')

@endsection


