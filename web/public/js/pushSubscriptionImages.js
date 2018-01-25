$(document).ready(function () {
    $("#delete-selected-images").on('click', function () {
        Ui.showConfirmDialog('test', function () {
            var toDelete = [];
            $('.image-checkbox').each(function () {
                if ($(this).is(':checked')) {
                    toDelete.push($(this).data('image-id'));
                }
            });
            if (toDelete.length === 0) {
                Ui.showInfoDialog("Nie zaznaczono żadnego obrazka");
                return;
            }

            var loadingDialog = Ui.showLoadingDialog();
            $.ajax({
                url: Routing.generate('bm_pushsubscription_delete_images'),
                type: 'DELETE',
                data: {ids: toDelete},
                success: function () {
                    loadingDialog.remove();
                    Ui.showInfoDialog('dziala')
                },
                error: function () {
                    loadingDialog.remove();
                    Ui.showInfoDialog('błąd');
                }
            })
        })
    });
});