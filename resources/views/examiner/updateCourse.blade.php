@extends("master")
@section('title')
	Edit Course details
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar');
		<div class="col m8">
			<h2 class="center-align">Create Quiz</h2>
			<form action="{{route('examiner.updateCourse')}}" class="card-panel" method="POST">
				<div class="row">
					<div class="input-field">
						<input type="hidden" name="id" value="{{$course->id}}">
						<input type="text" name="name" class="validate" id="name" value="{{$course->title}}">
						<label for="name">Quiz Name</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<input type="text" name="time" class="validate" id="time" value="{{$course->time}}">
						<label for="time"> Time</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<input type="text" name="qnumber" class="validate" id="number" value="{{$course->number}}">
						<label for="number"> Number of Questions</label>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn waves-block firebrick">Save</button>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

