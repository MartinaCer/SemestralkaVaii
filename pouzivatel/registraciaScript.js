$(document).ready(function () {
    $('#zaregistruj').click(function (e) {
        var chyba = document.getElementById("hlaska");
        if (chyba != null) {
            chyba.remove();
        }
        if ($('#registracia')[0].checkValidity()) {
            e.preventDefault();
            var meno = $('#meno').val();
            var heslo = $('#heslo').val();
            var hesloKontrola = $('#hesloKontrola').val();
            var email = $('#email').val();
            var telefon = $('#telefon').val();
            $.ajax
            ({
                type: "POST",
                url: "registraciaAjax.php",
                data: {
                    "meno": meno,
                    "heslo": heslo,
                    "hesloKontrola": hesloKontrola,
                    "email": email,
                    "telefon": telefon
                },
                success: function (data) {
                    if (data == "") {
                        window.location = "prihlasenie.php";
                    } else {
                        $("<div id='hlaska'>" + data + "</div>").appendTo("body");
                    }
                }
            });
        }
    });
});