function initModules() {
    $('.module').on('click', function () {
        console.log($(this).attr('id'));
        $('#submodules-' + $(this).attr('id')).toggle(200);

    });
}

$(document).ready(function () {
    initModules();
});

var Ui = {};
Ui.showConfirmDialog = function (message, yesCallback) {
    $('<div/>', {
        id: 'ui-confirm-dialog',
        text: message
    }).appendTo("#content");
    $('#ui-confirm-dialog').dialog({
        title: 'Potwierdź',
        buttons: {
            'Tak': function () {
                $(this).dialog('close');
                yesCallback();
            },
            'Nie': function () {
                $(this).dialog('close');
            }
        }
    });
};

Ui.showLoadingDialog = function () {
    $('<div/>', {
        id: 'ui-loading-dialog',
        text: "Przetwarzanie..."
    }).appendTo("#content");
    $('#ui-loading-dialog').dialog({});
    return $("#ui-loading-dialog");
};

Ui.showInfoDialog = function (message, callback) {
    $('<div/>', {
        id: 'ui-info-dialog',
        text: message
    }).appendTo("#content");
    $('#ui-info-dialog').dialog({
        title: 'Potwierdź',
        buttons: {
            'Zamknij': function () {
                $(this).dialog('close');
                if (typeof callback === 'function') {
                    callback();
                }
            }
        }
    });
}