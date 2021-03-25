let Question = {
    question: {},
    polls: {},
    questionItem: (question) => {
        return ` 
            <a href="/vote/questions/${question.code}" class="collection-item grey-text">
                <i class="fa fa-chevron-right"></i> ${question.question}
                <div class="secondary-content grey-text">${question.polls.length} polls</div>
            </a>
        `;
    },
    questionTable: (question) => {
        return `
            <tr id="question_${question.id}">
                <td>#${question.code}</td>
                <td>${question.question}</td>
                <td>${question.polls.length} polls</td>
                <td>
                    <a class="btn btn-flat green lighten-1 white-text waves-effect waves-light btn modal-trigger" onclick="findQuestion('${question.id}')" href="#edit_question_modal">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button class="btn btn-flat red lighten-1 white-text waves-effect waves-light" onclick="archiveQuestion('${question.id}')">
                        <i class="fa fa-times"></i>
                    </button>
                </td>  
            </tr>
        `;
    },
    questionTableData: (question, polls) => {
        return `
            <td>#${question.code}</td>
            <td>${question.question}</td>
            <td>${polls.length} polls</td>
            <td>
                <a class="btn btn-flat green lighten-1 white-text waves-effect waves-light btn modal-trigger" onclick="findQuestion('${question.id}')" href="#edit_question_modal">
                    <i class="fa fa-pencil"></i>
                </a>
                <button class="btn btn-flat red lighten-1 white-text waves-effect waves-light" onclick="archiveQuestion('${question.id}')">
                    <i class="fa fa-times"></i>
                </button>
            </td> 
        `;
    },
    questionPoll: (poll) => {
        return `
            <li class="collection-item" id="poll_${poll.id}">
                <div class="input-field">
                    <a class="right remove_poll_btn" onclick="$('#poll_${poll.id}').remove()">
                        <i class="fa fa-times"></i>
                    </a>
                    <label for="poll" class="active"><i class="fa fa-list"></i> Add Poll:</label>
                    <input type="text" name="poll[]" id="poll" placeholder="Enter your poll" required value="${poll.poll}">
                </div>
            </li>
        `;
    },
    questionArchive: (question) => {
        return `
            <tr id="question_${question.id}">
                <td>#${question.code}</td>
                <td>${question.question}</td>
                <td>${question.polls.length} polls</td>
                <td>
                    <a class="btn btn-flat orange lighten-1 white-text waves-effect waves-light btn" onclick="restoreQuestion('${question.id}')">
                        <i class="fa fa-times"></i>
                    </a>
                    <button class="btn btn-flat red lighten-1 white-text waves-effect waves-light" onclick="deleteQuestion('${question.id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>  
            </tr>
        `;
    },
    poll : (poll) => {
        return `
            <li class="collection-item">
                <input class="with-gap" name="poll_id" type="radio" id="vote_${poll.id}" value="${poll.id}"/>
                <label for="vote_${poll.id}">${poll.poll}</label>
                <small class="secondary-content">
                ${poll.votes.length} vote
                </small>
            </li>
        `;
    }
}

let questionsUrl = `${url}/question/list/json`;
function getQuestions() {
    loader();
    $.ajax({
        type: 'get',
        url: questionsUrl
    }).done(res => {
        swal.close();
        questionsUrl = res.questions.next_page_url;
        if(res.questions.next_page_url == null) {
            $('.btn_view_more_questions').remove();
        }
        for(var x in res.questions.data) {
            $('#questions_container').append(Question.questionItem(res.questions.data[x]));
        }
    }).fail(err => {
        console.log(err);
    })
}
// GET QUESTIONS FOR QUESTION PAGE

function getQuestionList() {
    loader();
    $.ajax({
        type: 'get',
        url: questionsUrl
    }).done(res => {
        swal.close();
        questionsUrl = res.questions.next_page_url;
        if (res.questions.next_page_url == null) {
            $('#view_more_question_list_btn').remove();
        }
        for(var x in res.questions.data) {
            $('#question_list_table_container').append(Question.questionTable(res.questions.data[x]));
        }
    }).fail(err => {
        console.log(err);
    })
}
// GET QUESTION LIST FOR TABLE
let questionArchiveUrl = `${url}/question/archive/json`;
function getQuestionArchive() {   
    loader();
    $.ajax({
        type: 'get',
        url: questionArchiveUrl
    }).done(res => {
        questionArchiveUrl = res.questions.next_page_url;
        if(res.questions.next_page_url == null) {
            $('#view_more_question_archive_btn').remove();
        }
        swal.close();
        console.log(res);
        for(var x in res.questions.data) {
            $('#question_archive_table_container').append(Question.questionArchive(res.questions.data[x]));
        }
    }).fail(err => {
        console.log(err);
    });
}

function archiveQuestion(id) {
    swal({
        title: "Are you sure?",
        text: "The selected question will be moved to archive.",
        dangerMode: true,
        buttons: true,
      }).then(willArchive => {
          if(willArchive) {
            $.ajax({
                type: 'post',
                url: `${url}/question/archive/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                console.log(res);
                $(`#question_${id}`).remove();
                Materialize.toast("Question sent to archive.", 1000);
            }).fail(err => {
                console.log(err);
            });
          }
      });
}

function restoreQuestion(id) {
    swal({
        title: "Are you sure?",
        text: "The selected question will be restored.",
        dangerMode: true,
        buttons: true,
      }).then(willRestore => {
          if (willRestore) {
            $.ajax({
                type: 'post',
                url: `${url}/question/restore/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                console.log(res);
                $(`#question_${id}`).remove();
                Materialize.toast("Question restored.", 1000);
            }).fail(err => {
                console.log(err);
            });
          }
      });
}

function deleteQuestion(id) {
    swal({
        title: "Are you sure?",
        text: "The selected question will be deleted.",
        dangerMode: true,
        buttons: true,
      }).then(willDelete => {
          if(willDelete) {
            $.ajax({
                type: 'delete',
                url: `${url}/question/delete/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done((res) => {
                console.log(res);
                $(`#question_${id}`).remove();
                Materialize.toast("Question deleted", 1000);
            }).fail(err => {
                console.log(err);
            });
          }
      });
}
// DELETE QUESTION THROUGH ID

function findQuestion(id) {
    loader();
    $('#poll_container li').remove();
    $('#question').val("");
    $.ajax({
        type: 'get',
        url: `${url}/question/find/id=${id}`
    }).done(res => {
        swal.close();
        Question.question = res.question;
        Question.polls = res.polls;
        $('#question').val(Question.question.question);
        for(var x in Question.polls) {
            $('#poll_container').append(Question.questionPoll(Question.polls[x]));
        }
    }).fail(err => {
        console.log(err);
    });
}
// FIND QUESTION THROUGH ID

function getPolls(code) {
    loader();
    $('#polls_container li').remove();
    $.ajax({
        type: 'get',
        url: `${url}/question/json/${code}`,
    }).done(res => {
        swal.close();
        console.log(res);
        for(var x in res.question.polls) {
            $('#polls_container').append(Question.poll(res.question.polls[x]));
        }   
    }).fail(err => {
        console.log(err);
    });
}
// GET QUESTION POLLS

$('#edit_question_form').on('submit', function(e) {
    loader();
    e.preventDefault();
    let question1 = new FormData(this);
    $.ajax({
        type: 'post',
        url: `${url}/question/update/id=${Question.question.id}`,
        data: question1,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        swal.close();
        console.log(res);
        $('#edit_question_modal').modal('close');
        Materialize.toast("Question Updated", 1000);
        $(`#question_${res.question.id} td`).remove();
        $(`#question_${res.question.id}`).append(Question.questionTableData(res.question, res.polls));
    }).fail(err => {
        console.log(err);
    });
});
// EDIT QUESTION FROM TABLE

$('#submit_vote_form').on('submit', function(e) {
    e.preventDefault();
    let vote1 = new FormData(this)
    $.ajax({
        type: 'post',
        url: `${url}/vote/create`,
        data: vote1,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        Materialize.toast("Vote submited",1000);
        getPolls(res.question.code);
        console.log(res);
    }).fail(err => {
        console.log(err);
        Materialize.toast(err.responseJSON.message);
    });
});
// SUBMIT VOTE 