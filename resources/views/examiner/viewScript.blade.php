@extends("master")
@section('title')
	View Script
@endsection

@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	{{ csrf_field() }}
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m5">
			<div class="row quiz-container">
				<?php $i = 1; ?>
				@foreach($scripts as $script)
					<div class="card-panel col s12 scripts">
						<div class="card-content">
							<h2 class="card-title quiz-title">Question {{ $i }}</h2>
							<div class="row">
								<p class="">Question: {{ $script->question->question }}</p>
							</div>
							<div class="row">
								<p class="">Student Answer: {{ $script->answer }}</p>
								<div class="row">
									<p class="col s6">Corrective
										Confidence(%): {{number_format($script->correctiveConfidence, 2, '.', ',')}}
										%</p>
									<p class="col s6">Keywords
										Matched(%): {{number_format($script->keywordsMatched, 2, '.', ',')}}
										%</p>
								</div>
								<p class="">Score: {{$script->score}}/{{$script->question->answer->marks}}</p>
								<small class="cyan">Time Taken: {{round($script->speed,4)}}</small>
							</div>
						</div>
					</div>
					<?php $i++; ?>
				@endforeach
			</div>

		</div>
		<div class="col m3 card-panel cyan white-text" style="">
			<p class="">Student name: {{ $quiz->user->name }}</p>
			<p class="">Student Total Score(%): {{ number_format($quiz->result,2,'.',',') }}%</p>
			<p class="">Total number of question: {{ count($scripts)}}</p>
			<p>Total Time Taken: {{round($totalTime,4)}}</p>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

