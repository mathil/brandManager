$(document).ready(function () {
    $(".datatables").each(function () {
        $(this).DataTable({
            "language": {
                "lengthMenu": "Pokazuj _MENU_ pozycji na stronie",
                "zeroRecords": "Niczego nie znaleziono",
                "info": "Strona _PAGE_ z _PAGES_",
                "infoEmpty": "Brak danych",
                "infoFiltered": "(znalezione spośród _MAX_ wszystkich pozycji)",
                "search": "Szukaj",
                "paginate": {
                    "previous": "Poprzednia",
                    "next": "Następna"
                }
            }
        });
    });
});