$(document).ready(function() {
    let table = null;

    $('#pr-form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    }).on('form:submit', function(e) {
        $('#results-table').css('display', 'none').css('width', '100%');
        if (table !== null) {
            table.destroy();
        }

        $('#submit').prop("disabled", true);

        $('.loader').css('display', 'block');

        $.ajax({
            url: "Logic/handler.php",
            data: {
                link: $('#link').val(),
                iterations: $('#iterations').val(),
            },
            type: 'POST'
        }).done(function(data) {
            $('.loader').css('display', 'none');
            table = $('#results-table').DataTable( {
                data: JSON.parse(data),
                columns: [
                    { data: 'path' },
                    { data: 'number_of_links' },
                    { data: 'rank' },
                ]
            } );

            $('#results-table').css('display', 'block');

            $('#submit').prop("disabled", false);
        });

        return false;
    });
});