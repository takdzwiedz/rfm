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

    $.ajax({
        url: 'group',
        method: 'post',
        success: function (res) {
            Object.keys(res).forEach(key => {
                $("#art").append("<a class=\"a-name\" href=\"#\" data-toggle=\"collapse\" id=\"" + res[key]['id'] + " \" >" + res[key]['nazwa_grupy'] + "</a>\n" +
                    "                        <a href=\"#homeSubmenu" + key + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                           class=\"a-arrow dropdown-toggle\" id=\"" + res[key]['id'] + "\" onclick=\"getAllClient(" + res[key]['id'] + ")\"></a>\n" +
                    "\n" +
                    "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + key + "\">\n" +
                    "                            <li class=\"\">\n" +
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

function getAllClient() {

}
