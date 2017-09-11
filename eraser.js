jQuery(document).ready(function($) {
    $('select#pType').change(function () {


            $.ajax({
                type: "POST",
                url: (ajax_object.ajax_url),
                data: ({
                    action: 'generate',
                    id: $('select#pType').val()
                }),
                success: function (msg) {
                    $('.pType').html(msg);
                }
            });
        });
    $("#sortable .delete").click(function() { 
        $(this).parent().remove();
    });
});