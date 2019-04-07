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
			<form action="{{route('examiner.processUploadQuestions')}}" class="card-panel" method="POST"
			      enctype="multipart/form-data">
				<div class="row">
					<div class="input-field">
						<select name="user" id="user">
							<option value="" disabled selected>Choose user</option>
							@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->name}}</option>
							@endforeach
						</select>
						<label for="course">Select User</label>
					</div>
				</div>
				<div class="row">
					<div class=" col sm10">
						<div class="input-field">
							<select name="course" id="course">
								<option value="" disabled selected>Choose your option</option>
								@foreach($courses as $course)
									<option value="{{$course->id}}">{{$course->title}}</option>
								@endforeach
							</select>
							<label for="course">Select Course</label>
						</div>
					</div>
					<div class="col sm2">
						<button formaction="{{route("examiner.download")}}" class="btn btn-sm" type="submit" formmethod="get">Download
							Template
						</button>
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
					<button type="submit" class="btn waves-block firebrick success">Upload</button>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

