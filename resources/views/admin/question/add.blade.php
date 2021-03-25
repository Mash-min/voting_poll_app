@extends('layouts.admin')

@section('content')
    <div class="col s12">
        <button class="btn btn-flat blue lighten-1 waves-effect waves-light white-text" onclick="addPoll()">
            <i class="fa fa-plus"></i> Add poll
        </button>
        <form id="add_poll_form" autocomplete="off">
            {{ @csrf_field() }}
            <ul class="collection with-header">
                <li class="collection-header"><h5>Create question</h5></li>
                <li class="collection-item">
                    <div class="input-field">
                        <label for="question"><i class="fa fa-question"></i> Add Question: </label>
                        <input type="text" name="question" id="question" placeholder="Enter your question">
                    </div>
                </li>
                <div id="poll_container">
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="poll" class="active"><i class="fa fa-list"></i> Add Poll:</label>
                            <input type="text" name="poll[]" id="poll" placeholder="Enter your poll" required>
                        </div>
                    </li>
                </div>
                <li class="collection-item">
                    <button class="btn btn-flat cyan darken-1 waves-effect waves-light white-text max-width" type="submit">
                        Save
                    </button>
                </li>
            </ul>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        $('#add_poll_form').on('submit', function(e) {
            loader();
            let questionData = new FormData(this);
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: `${url}/question/create`,
                data: questionData,
                cache: false,
                contentType: false,
                processData: false
            }).done(res => {
                swal.close();
                Materialize.toast("Question created!", 1000);
                $('#question').val('');
                $('#poll').val('');
                $('.extra_poll').remove();
                console.log(res);
            }).fail(err => {
                console.log(err);
            })
        })
    </script>

@endsection