$(document).ready(function () {

    const table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        // order: [[ 2, "desc" ]]

    });
    $('#example thead tr').clone(true).appendTo('#example thead');
    $('#example thead tr:eq(1) th').each(function (i) {
        var title = $(this).text();

        $(this).html('<input type="text" placeholder="szukaj" />');

        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });

});
