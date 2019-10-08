$(document).ready(function () {
    $('table.display').DataTable({
        "iDisplayLength": 10,
        "order": [[ 3, "desc" ]]
    });
});