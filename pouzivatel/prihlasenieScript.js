$(document).ready(function () {
    $('#prihlas').click(function (e) {
        var chyba = document.getElementById("hlaska");
        if (chyba != null) {
            chyba.remove();
        }
        if ($('#login')[0].checkValidity()) {
            e.preventDefault();
            var meno = $('#meno').val();
            var heslo = $('#heslo').val();
            $.ajax
            ({
                type: "POST",
                url: "prihlasenieAjax.php",
                data: {"meno": meno, "heslo": heslo},
                success: function (data) {
                    if (data == "") {
                        window.location = "../produkty/produkty.php";
                    } else {
                        $("<div id='hlaska'>" + data + "</div>").appendTo("body");
                    }
                }
            });
        }
    });
});