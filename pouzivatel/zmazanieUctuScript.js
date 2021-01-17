$(document).ready(function () {
    $('#zmaz').click(function (e) {
        var hlaska = document.getElementById("hlaska");
        if (hlaska != null) {
            hlaska.remove();
        }
        if ($('#zmazUcet')[0].checkValidity()) {
            e.preventDefault();
            var heslo = $('#heslo').val();
            $.ajax
            ({
                type: "POST",
                url: "zmazanieUctuAjax.php",
                data: {"heslo": heslo},
                success: function (data) {
                    if (data == "") {
                        window.location = "odhlasenie.php";
                    } else {
                        $("<div id='hlaska'>" + data + "</div>").appendTo("body");
                    }
                }
            });
        }
    });
});