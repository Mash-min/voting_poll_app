@extends('layouts.admin')

@section('content')
    {{ @csrf_field() }}
    <table class="bordered centered responsive-table">
        <thead>
          <tr>
              <th>Code</th>
              <th>Question</th>
              <th># of polls</th>
              <th>Options</th>
          </tr>
        </thead>

        <tbody id="question_archive_table_container">
            <!-- append here -->
        </tbody>
    </table>
    <button class="btn btn-flat cyan darken-1 white-text waves-effect waves-light max-width" onclick="getQuestionArchive()" id="view_more_question_archive_btn">
        View more
    </button>
@endsection

@section('scripts')
    <script src="/js/Question.js"></script>
    <script>
        $(document).ready(() => {
            getQuestionArchive();
        });
    </script>
@endsection