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


$("#searchProduct").keyup(  function() {
    if ($(this).val().length >2 ) {
        // console.log($(this).val())
        $.ajax({
            url: window.location.href.split('/')[0] + '/search-product/' + $(this).val(),
            success: function (res) {
                let product = [];
                for (var k in res) {
                    // console.log(res[k]);
                    product.push(res[k]['nazwa_artykulu'])
                }

                autocomplete(document.getElementById("searchProduct"), product);
                // $("searchProduct").autocomplete({
                //     source: product
                // });
            },
            error: function () {
                console.log('failure to get product list');
            },
        })

    };
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
                    "                   class=\"a-arrow dropdown-toggle\" onclick=\"getAllClient(" + res[key]['id_grupy'] + ")\" ></a>\n" +
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
                $("#group" + idGroup).append("<a href=\"" + url + "/client-order/" + res[key]['id'] + "\" id=\"" + res[key]['id'] + " \" class=\"a-name\" >" + res[key]['nazwa_kontrahenta'] + "</a>\n" +
                    "</a>                <a style=\"\" href=\"#homeSubmenu" + res[key]['id'] + "\" data-toggle=\"collapse\" aria-expanded=\"false\"\n" +
                    "                   class=\"a-arrow dropdown-toggle\" onclick=\"getAllClient(" + res[key]['id'] + ")\" ></a>\n" +
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

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

autocomplete(document.getElementById("search"), products);