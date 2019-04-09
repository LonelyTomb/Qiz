@extends("master")
@section('title')
	View Courses
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('examiner.sidebar')
		<div class="col m8">
			<div class="row quiz-container">
				@foreach( $courses as $course)
					<div class="card quiz col s4">
						<div class="card-content">
							<h2 class="card-title quiz-title">{{$course->title}}</h2>
							<div class="card-action">
								<a href="courses/update/{{$course->id}}" class="btn waves-block">Edit
									Course Details</a>
								<a href="courses/view/{{$course->id}}" class="btn waves-block">View
									Questions</a>
								<a href="courses/add/{{$course->id}}" class="btn waves-block">Add
									Questions</a>
							</div>
							<div><a href="{{route('examiner.selectCourse',['id'=>$course->id])}}" class="btn btn-danger waves-block left">Upload Scripts</a></div>
							<div><a href="{{route('examiner.deleteCourse',['id'=>$course->id])}}" class="btn btn-danger waves-block materialize-red right">Delete</a></div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

