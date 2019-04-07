@extends("master")
@section('title')
	View Examiners
@endsection
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div class="row">
        @include('admin.sidebar');
        <div class="col m8">
            <h2 class="center-align">List of all Examiners</h2>

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

