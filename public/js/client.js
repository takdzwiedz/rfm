$(document).ready(function () {
    var t = $('#example').DataTable({
        "columnDefs": [{
            "searchable": true,
            "orderable": true,
            "targets": 4,

        }],
        "order": [[4, 'desc']],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Polish.json"
        },
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

});