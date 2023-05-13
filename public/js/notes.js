function all() 
{
    $.ajax({
        type: 'GET',
        url: 'notes/all',
        success: function () {
            console.log('update data success!')
        }
    })
}

function resetForm(selector) 
{
    $(selector)[0].reset();
}

// Modal function
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
                $('#note-id-delete').val(note.id);
                $('#note-title').val(note.title);
                $('#note-body').val(note.body);
                
                // Show modal
                $('#note-container').show();

                // Open modal effect
                $('.modal-backdrop').toggleClass('fade-out');
                $('.modal-backdrop').toggleClass('fade-in');

                // Close modal effect
                $('.modal-panel').toggleClass('fade-out');
                $('.modal-panel').toggleClass('fade-in');
            }
        });
}

function closeModal() {
    const modalContainer = document.getElementById("note-container");

    $('#note-container').on('click', '#note-close-btn', function () {
        $('#note-body').val('')
    });

    $('.modal-backdrop').toggleClass('fade-in');
    $('.modal-backdrop').toggleClass('fade-out');
    $('.modal-panel').toggleClass('fade-in');
    $('.modal-panel').toggleClass('fade-out');

    modalContainer.style.display = 'none'
}


// Execute function when finished loading the page
document.addEventListener('DOMContentLoaded', function() {

    $('#notes-container')
        .on('mouseenter', '.note-card', function() {
            $(this).find('.note-attr').addClass('fade-in').removeClass('fade-out')
        })
        .on('mouseleave', '.note-card', function() {
            $(this).find('.note-attr').addClass('fade-out').removeClass('fade-in');
        })
        .on('click', 'button', function() {
            editNote($(this));
        })

// -------------------------------------

    // Autosize textarea
    autosize($('#body'));
    autosize($('#note-body'));

    // Close note modal
    $('#note-close-btn').on('click', closeModal)

    $(document).on('keydown', event => {
        if (event.key === 'Escape') {
            closeModal()
        }
    });

    // Submit updated input data
    $('#note-title, #note-body').on('input', function() {
        let inputTitle = $('#note-title').val()
        let inputBody = $('#note-body').val()

        inputData = {
            'title': inputTitle,
            'body': inputBody
        }
        
        $('#note-update-btn').click(function(event) {
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

                    closeModal()
                }
            })
        })
    })

/// ----------------------------------------------


})