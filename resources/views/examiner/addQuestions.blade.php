@extends("master")
@section('title')
	Add Question
@endsection
@section('style')
	<style>
		.tags-input {
			padding: 8px 10px;
			display: inline;
		}
	</style>
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m8">
			<h3 class="center-align">Add Questions to {{$course->title}} </h3>
			<form action="{{route('examiner.saveQuestions')}}" class="card-panel" method="POST">
				<div class="row">
					<div class="input-field">
						<input type="hidden" name="id" value="{{$course->id}}">
						<input type="text" name="question" id="question">
						<label for="question">Question {{$count+1}}:</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<textarea class="materialize-textarea" name="answer" id="answer"></textarea>
						<label for="answer">Answer to Question {{$count+1}}:</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<input type="text" name="marks" id="marks">
						<label for="marks">Marks awarded:</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<input type="tags" id="keywords" name="keywords" class="tags-input" placeholder="Keywords">

					</div>
				</div>

				{{ csrf_field() }}

				<div class="row">
					<button type="submit" name="save" class="btn">Save</button>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

