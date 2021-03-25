let Poll = {
    pollInput: () => {
        return `
            <li class="collection-item extra_poll">
                <div class="input-field">
                    <label for="poll" class="active"><i class="fa fa-list"></i> Add Poll:</label>
                    <input type="text" name="poll[]" placeholder="Enter your poll" required>
                </div>
            </li>
        `;
    }
}

const url = location.protocol+'//'+location.host;
$(document).ready(function() {
    $(".button-collapse").sideNav();
    $('.modal').modal();
});

$('#sumbit_vote_1').on('submit', function(e) {
    e.preventDefault();
    let vote1 = new FormData(this);
    console.log($(this).serialize());
});

function addPoll() {
    $('#poll_container').append(Poll.pollInput());
}

function loader() {
    swal({
        text: 'loading',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    });
}

function success(message) {
    swal(message);
}