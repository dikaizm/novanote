function resetForm(selector) {
    $(selector)[0].reset();
}

// ----------------- Modal function ------------------

function createNote(form) {
    let inputData = $(form).serialize();

    let decodeStr = decodeURIComponent(inputData)

    var keyValuePairs = decodeStr.split('&');
    var json = {};

    keyValuePairs.forEach(function (keyValuePair) {
        var equalsIndex = keyValuePair.indexOf('=');
        var key = keyValuePair.substring(0, equalsIndex);
        var value = keyValuePair.substring(equalsIndex + 1);
        json[key] = value;
    });

    $.ajax({
        type: 'POST',
        url: 'note/create',
        data: {
            inputData: JSON.stringify(json)
        },
        success: function (response) {
            let status = JSON.parse(response);

            if (status.body != 'true') {
                $('#note-error').html(status.body)
            } else {
                resetForm('#input-form');

                $('#notes-container').load(location.href + ' #notes-container > *');
            }
        }
    })
}


function editNote(name) {
    const id = $(name).data('id');

    $.ajax({
        type: 'POST',
        url: 'note/edit',
        data: { id: id },
        success: function (response) {
            let note = JSON.parse(response);

            // Pass data into note modal
            $('#note-id-update').val(note.id);
            $('#note-update-btn').data('id', note.id);
            $('#note-delete-btn').data('id', note.id);
            $('#note-title').val(note.title);
            $('#note-body').val(note.body);

            // Show modal
            $('#note-container').show();

            // Open modal effect
            $('.modal-backdrop').addClass('fade-in').removeClass('fade-out')
            $('.modal-panel').addClass('fade-in').removeClass('fade-out')
        }
    });
}

function closeModal() {
    $('.modal-backdrop').removeClass('fade-in').addClass('fade-out')
    $('.modal-panel').removeClass('fade-in').addClass('fade-out')

    $('#note-container').hide();
    resetForm('#edit-form');
}

function updateNote() {
    let inputTitle = $('#note-title').val()
    let inputBody = $('#note-body').val()

    inputData = {
        'title': inputTitle,
        'body': inputBody
    }

    console.log(inputData)

    $('#note-update-btn').click(function (event) {
        event.preventDefault();

        const id = $('#note-update-btn').data('id');

        $.ajax({
            type: 'POST',
            url: 'note/update',
            data: {
                id: id,
                inputData: JSON.stringify(inputData)
            },
            success: function () {
                $('#notes-container').load(location.href + ' #notes-container > *');

                closeModal();
            }
        })
    })
}

function deleteNote(event) {
    event.preventDefault();

    const id = $('#note-delete-btn').data('id');

    $.ajax({
        type: 'POST',
        url: 'note/delete',
        data: {
            id: id,
        },
        success: function () {
            $('#notes-container').load(location.href + ' #notes-container > *');

            closeModal();
        }
    })
}


// Execute function when finished loading the page
document.addEventListener('DOMContentLoaded', function () {

    // Autosize textarea
    autosize($('#create-note-body'));
    autosize($('#note-body'));

    // ----------------- Note modal interaction ------------------

    // Create note
    $('#input-form').on('submit', function (event) {
        event.preventDefault();
        createNote(this);
    });

    // Edit note modal
    $('#notes-container')
        .on('mouseenter', '.note-card', function () {
            $(this).find('.note-attr').addClass('fade-in').removeClass('fade-out')
        })
        .on('mouseleave', '.note-card', function () {
            $(this).find('.note-attr').addClass('fade-out').removeClass('fade-in');
        })
        .on('click', 'button', function () {
            editNote($(this));
        })

    // Close note modal
    $('#note-close-btn').on('click', closeModal)

    $(document).on('keydown', event => {
        if (event.key === 'Escape') {
            closeModal()
        }
    });

    // Submit updated input data
    $('#note-title, #note-body').on('input', updateNote)

    // Delete note modal
    $('#note-delete-btn').on('click', deleteNote)

})