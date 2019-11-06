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

        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            tatal = (Math.round(total * 100)/100).toFixed(2);

            // Total over this page
            pageTotal = api
                .column(4, {page: 'current'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            pageTotal = (Math.round(pageTotal * 100)/100).toFixed(2);

            // Update footer
            $(api.column(4).footer()).html(
                pageTotal +
                ' ('
                + tatal
                + ' zł)'
            );
        }
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});
