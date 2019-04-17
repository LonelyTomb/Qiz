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
			<h2 class="center-align">Upload Questions And Answers</h2>
			<form action="{{route('examiner.uploadQuestions.save',['id'=>request()->route('id')])}}" class="card-panel" method="POST"
			      enctype="multipart/form-data">
				{{--<div class="row">--}}
					{{--<p>--}}
						{{--<button formaction="{{route("examiner.download")}}" class="btn btn-sm" type="submit"--}}
						        {{--formmethod="get">Download Excel Template--}}
						{{--</button>--}}
					{{--</p>--}}
				{{--</div>--}}
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

