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
			<h2 class="center-align">Upload Users</h2>
			<form action="{{route('examiner.uploadUsers')}}" class="card-panel" method="POST" enctype="multipart/form-data">
				<div class="col sm2">
					<a href="{{$template}}" class="btn btn-sm" type="submit">Download
						Template
					</a>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="file-field input-field">
						<div class="btn">
							<span>File</span>
							<input type="file" name="file" id="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Upload user excel sheet">
						</div>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn waves-block firebrick success">Upload</button>
				</div>
				{{ csrf_field() }}
			</form>
            <button formaction="{{route("examiner.getUsers")}}" class="btn btn-sm" type="submit" formmethod="get">Export
                Users
            </button>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

