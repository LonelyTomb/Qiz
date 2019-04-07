@extends("master")
@section('title')
	Home(Admin)
@endsection
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div class="row">
        @include('admin.sidebar');
        <div class="col m8">
            <h2 class="center-align">Create Quiz</h2>
            <table>
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
              </tr>
            </thead>
        @foreach($examiners as $examiner)
            <tbody>
              <tr>
                <td>{{$examiner->name}}</td>
                <td>{{$examiner->email}}</td>
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

