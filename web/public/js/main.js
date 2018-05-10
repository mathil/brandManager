function initModules() {
    $('.module').on('click', function () {
        console.log($(this).attr('id'));
        $('#submodules-' + $(this).attr('id')).toggle(200);

    });
}

$(document).ready(function () {
    initModules();
    Ui.initDatePicker();
});

var Ui = {};
Ui.showConfirmDialog = function (message, yesCallback) {
    $('<div/>', {
        id: 'ui-confirm-dialog',
        text: message
    }).appendTo("#content");
    $('#ui-confirm-dialog').dialog({
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

Ui.showLoadingDialog = function (message) {
    $('<div/>', {
        id: 'ui-loading-dialog',
        text: message
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
        buttons: {
            'Zamknij': function () {
                $(this).dialog('close');
                if (typeof callback === 'function') {
                    callback();
                }
            }
        }
    });
};

Ui.initDatePicker = function () {
    $('.datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
}