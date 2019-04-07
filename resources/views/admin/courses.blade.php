@extends("master")
@section('title')
	View Courses
@endsection
@section('navbar')
	@include('partials.navbar')
@endsection
@section('content')
	<div class="row">
		@include('admin.sidebar');
		<div class="col m8">
			<h2 class="center-align">List of all Courses</h2>
			<table>
				<thead>
				<tr>
					<th>Title</th>
					<th>Question No</th>
					<th>Time</th>
				</tr>
				</thead>
				@foreach($courses as $course)
					<tbody>
					<tr>
						<td>{{$course->title}}</td>
						<td>{{$course->number}}</td>
						<td>{{$course->time}} mins</td>
					</tr>
					@endforeach
					</tbody>
			</table>
		</div>
	</div>
@endsection
@section('footer')
	@include('partials.footer')
@endsection

