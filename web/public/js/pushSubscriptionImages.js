$(document).ready(function () {
    $("#delete-selected-images").on('click', function () {
        Ui.showConfirmDialog(Translator.trans('bm.dialog.confirm_delete_multiple'), function () {
            var toDelete = [];
            $('.image-checkbox').each(function () {
                if ($(this).is(':checked')) {
                    toDelete.push($(this).data('image-id'));
                }
            });
            if (toDelete.length === 0) {
                Ui.showInfoDialog(Translator.trans('bm.dialog.no_element_selected'));
                return;
            }

            var loadingDialog = Ui.showLoadingDialog(Translator.trans('bm.dialog.delete_processing'));
            $.ajax({
                url: Routing.generate('bm_pushsubscription_delete_images'),
                type: 'DELETE',
                data: {ids: toDelete},
                success: function () {
                    loadingDialog.remove();
                    Ui.showInfoDialog(Translator.trans('bm.dialog.delete_success'))
                },
                error: function () {
                    loadingDialog.remove();
                    Ui.showInfoDialog(Translator.trans('bm.dialog.delete_fail'));
                }
            })
        })
    });
});