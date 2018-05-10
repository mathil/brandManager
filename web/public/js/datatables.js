$(document).ready(function () {

    var params = {
        "language": {
            "lengthMenu": Translator.trans('bm.datatables.length_menu'),
            "zeroRecords": Translator.trans('bm.datatables.zero_records'),
            "info": Translator.trans('bm.datatables.info'),
            "infoEmpty": Translator.trans('bm.datatables.info_empty'),
            "infoFiltered": Translator.trans('bm.datatables.info_filtered'),
            "paginate": {
                "previous": Translator.trans('bm.datatables.paginate.previous'),
                "next": Translator.trans('bm.datatables.paginate.next')
            },
            "processing": Translator.trans('bm.datatables.processing')
        },
        "dom": '<"top">rt<"empty-block"><"bottom"p><"text-center"l>'
    }

    $(".datatables").each(function () {
        var table = $(this);
        var searchForm = null;
        if (table.data('load-ajax')) {
            var route = $(this).data('data-route');
            params.ajax = route;
            params.processing = true;
            params.serverSide = true;
        }
        var datatable = table.DataTable(params);
        if ($('.search-box-form')) {
            $('.search-box-form').on('submit', function (evt) {
                evt.preventDefault();
                searchForm = $(this).serialize();
                datatable.search(searchForm).draw();
            });
        }

        $("#clear-search-form").on('click', function () {
            console.log('click');
            ($('.search-box-form')).find('input').val("");
            datatable.search('clear').draw();
        });

    });

});

