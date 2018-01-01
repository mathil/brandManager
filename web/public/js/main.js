function initModules() {
    $('.module').each(function () {
        var module = $(this).attr('id');
        $(this).on('click', function () {
            console.log($(this));
            $("#submodules-" + module).toggle(200);
        });
    });
}

$(document).ready(function () {
    initModules();
});