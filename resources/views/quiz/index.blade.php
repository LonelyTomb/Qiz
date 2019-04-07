@extends("master")

@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('student.sidebar')
		<div class="col m8">
			<?php $i = 1; ?>
			<div class="row quiz-container">
				@foreach($courses as $course)
					@if ($i > 1) @endif
					<div class="card quiz col s4">
						<form action="quiz/show/{{ $course->id }}" method="get">
							<div class="card-content">
								<h2 class="card-title quiz-number">Quiz No: {{ $i }}</h2>

								<div class="quiz-desc">
									<div class="row">
										<h3 class="quiz-title">{{ $course->title }}</h3>
										<hr>
										<div class="input-groups">
											<input type="checkbox" name="timer" id="timer" checked>
											<label for="timer">Enable Timer</label>
										</div>
									</div>
									<div class="center-align">
										<button type="submit" class="btn btn-flat">
											Start
										</button>
									</div>
								</div>

							</div>
						</form>
					</div>
					<?php $i++; ?>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

