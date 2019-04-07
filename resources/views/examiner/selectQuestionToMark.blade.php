@extends("master")
@section('title')
	Upload Questions And Answers
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m8">
			<h2 class="center-align">Upload Scripts</h2>
			<form action="{{route('examiner.processUploadUserQuestions',['id'=>request()->route('id')])}}"
			      class="card-panel" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="input-field">
						<label for="quiz" class="">Quiz No:</label>
						<input id="quiz" type="text" class="form-control" name="quiz"
						       value="{{ old('quiz') }}" required autofocus placeholder="Enter Quiz Id">
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<select name="question" id="question">
							<option value="" disabled selected>Choose your question</option>
							@foreach($questions as $question)
								<option value="{{$question->id}}">{{$question->question}}</option>
							@endforeach
						</select>
						<label for="question">Select Question</label>
					</div>
				</div>
				<div class="row">
					<div class="file-field input-field">
						<div class="btn">
							<span>File</span>
							<input type="file" name="file" id="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Upload excel sheet">
						</div>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn waves-block firebrick success">Submit</button>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

