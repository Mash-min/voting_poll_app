@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">
            <ul class="collection with-header question-item">
                <li class="collection-header"><h4>Questions</h4></li>
                <div id="questions_container">
                    <!-- append here -->
                </div>
            </ul>
        </div>
    </div>
    <div class="container row">
        <div class="col l6 offset-l3 m8 offset-m2 s12 question-item">
            <button class="btn btn-flat cyan darken-1 waves-effect waves-light white-text max-width btn_view_more_questions" onclick="getQuestions()">
                View more
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/Question.js"></script>
    <script>
        $(document).ready(function() {
            getQuestions();
        });
    </script>
@endsection