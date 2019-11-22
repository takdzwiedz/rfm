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


var getClientGroupLoaded = false;

function getAllClientGroups() {

    if (getClientGroupLoaded) {
        return
    }

    var url = window.location.origin;
    $.ajax({
        url: window.location.href.split('/')[0] + '/group',
        method: 'post',
        success: function (res) {
            Object.keys(res).forEach(key => {
                $("#group").append("<a href=\"" + url + "/group-order/" + res[key]['id_grupy'] + "\" id=\"" + res[key]['id_grupy'] + " \" class=\"a-name\" >" + res[key]['nazwa_grupy'] +
                    "</a>                <a style=\"\" href=\"#homeSubmenu" + res[key]['id_grupy'] + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                   class=\"a-arrow dropdown-toggle\" onclick=\"getAllClient("+ res[key]['id_grupy'] + ")\" ></a>\n" +
                    "\n" +
                    "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + res[key]['id_grupy'] + "\">\n" +
                    "                            <li id=\"group" + res[key]['id_grupy'] + "\">\n" +
                    "                            </li >" +
                    "</ul>\n")
            });
            getClientGroupLoaded = true;
        },
        error: function () {
            console.log('failure');
        },
    })
}



function getAllClient(idGroup) {


    var url = window.location.origin;
    $.ajax({
        url: window.location.href.split('/')[0] + '/group-client/' + idGroup,
        method: 'post',
        success: function (res) {
            Object.keys(res).forEach(key => {
                $("#group"+ idGroup).append("<a href=\"" + url + "/client-order/" + res[key]['id'] + "\" id=\"" + res[key]['id'] + " \" class=\"a-name\" >" + res[key]['nazwa_kontrahenta'] + "</a>\n" +
                    "</a>                <a style=\"\" href=\"#homeSubmenu" + res[key]['id'] + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                   class=\"a-arrow dropdown-toggle\" onclick=\"getAllClient("+ res[key]['id'] + ")\" ></a>\n" +
                    "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + key + "\">\n" +
                    "                            <li id=\"client" + res[key]['id'] + "\">\n" +
                    "                            </li >" +
                    "</ul>\n")
            });
        },
        error: function () {
            console.log('failure');
        },
    })
}


var getAllCategoriseLoaded = false;

function getAllCategories() {

    if (getAllCategoriseLoaded) {
        return;
    }
    var url = window.location.origin;
    $.ajax({
        url: window.location.href.split('/')[0] + '/category',
        method: 'post',
        success: function (res) {
            Object.keys(res).forEach(key => {
                console.log(res[key]['id_category'])

                if (res[key]['id_category'] !== '0') {

                    $("#category").append("<a href=\"" + url + "/category/" + res[key]['id_parent'] + "\" id=\"" + res[key]['id_kategorii'] + " \" class=\"a-name\" >" + res[key]['nazwa_kategorii'] + "</a>\n" +
                        "\n" +
                        "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + key + "\">\n" +
                        "                            <li id=\"client" + res[key]['id_kategorii'] + "\">\n" +
                        "                            </li >" +
                        "</ul>\n")
                } else {
                    $("#category").append("<a href=\"" + url + "/category/" + res[key]['id_parent'] + "/" + res[key]['id_category'] + "\" id=\"" + res[key]['id_kategorii'] + " \" class=\"a-name\" >" + res[key]['nazwa_kategorii'] + "</a>\n" +
                        "\n" +
                        "                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu" + key + "\">\n" +
                        "                            <li id=\"client" + res[key]['id_kategorii'] + "\">\n" +
                        "                            </li >" +
                        "</ul>\n")
                }


            });


            getAllCategoriseLoaded = true;
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
