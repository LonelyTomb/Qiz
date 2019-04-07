@extends("master")

@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div class="row">
        @include('student.sidebar');
        <div class="col m8">
            <div class="row quiz-container">
                <div class="card quiz col s4">
                    <div class="card-content">
                        <h2 class="card-title quiz-title">Quizzes available</h2>

                        <div class="quiz-desc">
                            {{ $quizzes }}
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('partials.footer')
@endsection

