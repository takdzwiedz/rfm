$(document).ready(function () {
    let jQuery;
    jQuery = $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });


    let r = Math.floor(Math.random() * 11);
});

function getAllClientGroups() {

    var url = window.location.origin;
    $.ajax({
        url: window.location.href.split('/')[0] + '/group',
        method: 'post',
        success: function (res) {
            Object.keys(res).forEach(key => {
                $("#group").append("<a href=\"" + url + "/group-order/" + res[key]['id_grupy'] + "\" id=\"" + res[key]['id_grupy'] + " \" class=\"a-name\" >" + res[key]['nazwa_grupy'] + "</a>\n" +
                    "                        <a href=\"#homeSubmenu" + key + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                           class=\"a-arrow dropdown-toggle\" id=\"" + res[key]['id_grupy'] + "\" onclick=\"getAllClient(" + res[key]['id_grupy'] + ")\"></a>\n" +
                    "\n" +
                    "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + key + "\">\n" +
                    "                            <li id=\"client" + res[key]['id_grupy'] + "\">\n" +
                    "                                <a href=\"#\" class=\"a-name\">Kontrahent 1</a>\n" +
                    "                                <a href=\"#homeSubmenu3" + key + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                                   class=\"a-arrow dropdown-toggle\"></a>\n" +
                    "                                <ul class=\"collapse list-unstyled\" id=\"homeSubmenu3" + key + "\">\n" +
                    "                            <li class=\"\">\n" +
                    "                                <a href=\"#\" class=\"a-name\">Użytkownik 1</a>\n" +
                    "                                <a href=\"#homeSubmenu4" + key + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                                   class=\"a-arrow dropdown-toggle\"></a>\n" +
                    "                                <ul class=\"collapse list-unstyled\" id=\"homeSubmenu4" + key + "\">\n" +
                    "                                    <li>\n" +
                    "                                        <a href=\"#\">Zamówienie 1</a>\n" +
                    "                                    </li>\n" +
                    "                                    <li>\n" +
                    "                                        <a href=\"#\">Zamówienie 2</a>\n" +
                    "                                    </li>\n" +
                    "                                    <li>\n" +
                    "                                        <a href=\"#\">Zamówienie 3</a>\n" +
                    "                                    </li>\n" +
                    "                                </ul>\n" +
                    "                            </li>\n" +
                    "                                    <li>\n" +
                    "                                        <a href=\"#\">Użytkownik 2</a>\n" +
                    "                                    </li>\n" +
                    "                                    <li>\n" +
                    "                                        <a href=\"#\">Użytkownik 3</a>\n" +
                    "                                    </li>\n" +
                    "                                </ul>\n" +
                    "                            </li>\n" +
                    "                            <li>\n" +
                    "                                <a href=\"#\">Kontrahent 2</a>\n" +
                    "                            </li>\n" +
                    "                            <li>\n" +
                    "                                <a href=\"#\">Kontrahent 3</a>\n" +
                    "                            </li>\n" +
                    "</li>");
            });
        },
        error: function () {
            console.log('failure');
        },
    })
}
//
// function getAllClient(id_group) {
//     var url = window.location.origin;
//     $.ajax({
//         url: window.location.href.split('/')[0] + '/group-client/' + id_group,
//         method: 'post',
//         success: function (res) {
//             Object.keys(res).forEach(key => {
//                 let id = '#client' + id_group;
//                 console.log(id);
//                 document.getElementById(id).append("<a href=\"dupa\" </a>")
//                 $("#client1")
//
//             });
//         },
//         error: function () {
//             console.log('failure');
//         },
//     })
// }
