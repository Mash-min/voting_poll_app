@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">
            <form id="submit_vote_form">
                {{ @csrf_field() }}
                <input type="hidden" name="question_code" value="{{ $question->code }}">
                <ul class="collection with-header" id="question_form_container">
                    <li class="collection-header">
                        <p class="question-title">{{ $question->question }}</p>
                    </li>
                    <div id="polls_container">
                        <!-- append here -->
                    </div>
                    <li>
                        <button class="btn btn-flat cyan lighten-1 white-text waves-effect waves-light max-width" type="submit">
                            Submit vote
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="/js/Question.js"></script>
    <script>
        $(document).ready(() => { getPolls('{{ $question->code }}') });
    </script>
@endsection