$(document).ready(function () {
    $('table.display').DataTable({
        "iDisplayLength": 25,
        "order": [[ 5, "desc" ]]
    });

});