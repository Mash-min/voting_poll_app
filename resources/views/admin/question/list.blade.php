@extends('layouts.admin')

@section('content')
    {{ @csrf_field() }}
    <table class="bordered centered responsive-table striped">
        <thead>
          <tr>
              <th>Code</th>
              <th>Question</th>
              <th># of polls</th>
              <th>Options</th>
          </tr>
        </thead>

        <tbody id="question_list_table_container">
            <!-- append here -->
        </tbody>
    </table>

    <div id="edit_question_modal" class="modal modal-fixed-footer">
        <form autocomplete="off" id="edit_question_form">
            <div class="modal-content">
                {{ @csrf_field() }}
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Edit question</h5></li>
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="question"><i class="fa fa-question"></i> Add Question: </label>
                            <input type="text" name="question" id="question" placeholder="Enter your question">
                        </div>
                    </li>
                    <div id="poll_container">
                        <!-- append here -->
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-flat blue lighten-1 waves-effect waves-light white-text left" onclick="addPoll()" type="button">
                    <i class="fa fa-plus"></i> Add poll
                </button>
                <a class="modal-action modal-close waves-effect waves-light btn-flat red white-text">Cancel</a>
                <button class="btn btn-flat green lighten-1 white-text waves-effect waves-light" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
    <button class="btn btn-flat cyan darken-1 white-text waves-effect waves-light max-width" onclick="getQuestionList()" id="view_more_question_list_btn">
        View more
    </button>
@endsection

@section('scripts')
    <script src="/js/Question.js"></script>
    <script>
        $(document).ready(function() {
            getQuestionList();
        });
    </script>
@endsection