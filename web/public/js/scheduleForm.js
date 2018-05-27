$(document).ready(function () {
    $('.choose-all-select2').on('click', function () {
        var choices = $(this).data('choices-name');
        if ($(this).is(':checked')) {
            $('[data-choices=' + choices + '] > option').prop("selected", "selected");
        } else {
            $('[data-choices=' + choices + '] > option').prop("selected", false);
        }
            $('[data-choices=' + choices + ']').trigger('change');
    });
});