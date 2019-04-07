@extends("master")
@section('title')
	View Students
@endsection
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div class="row">
        @include('admin.sidebar');
        <div class="col m8">
            <h2 class="center-align">List of all Students</h2>

            <table>
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
              </tr>
            </thead>
        @foreach($students as $student)
            <tbody>
              <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>
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

