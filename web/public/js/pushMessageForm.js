$(document).ready(function () {
    $("#bm_push_message_form_openUrl").on('change', function () {
        if ($(this).is(':checked')) {
            $(".bm_push_message_url_address").css('visibility', '');
        } else {
            $(".bm_push_message_url_address").css('visibility', 'hidden');
            $(".bm_push_message_url_address").val("");
        }
    });
})