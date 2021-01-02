<?php
require_once "../pripojenie.php";
if (isset($_SESSION["id"])) {
    header("Location: ../produkty/produkty.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="divHlavicka">
    <img class="nadpis" src="../obrazky/nadpis.JPG">
</div>
<div class="formular">
    <h2>Vytvorte si nový účet.</h2>
    <form class="formular" id="registracia" method="post">
        <input name="meno" id="meno" placeholder="Login" type="text" required><br><br>
        <input name="heslo" id="heslo" placeholder="Heslo" type="password" required><br><br>
        <input name="hesloKontrola" id="hesloKontrola" placeholder="Kontrola hesla" type="password"
               required><br><br>
        <input name="email" id="email" placeholder="Email" type="email" required
               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br><br>
        <input name="telefon" id="telefon" placeholder="Telefónne číslo" type="tel" required
               pattern="^[0-9]{1,15}$"><br><br>
        <input class="button" name="zaregistruj" id="zaregistruj" type="submit" value="Zaregistruj sa!">
    </form>
    Už máte účet? <a href="prihlasenie.php"><b>Prihláste sa!</b></a>
</div>
<script>
    $(document).ready(function () {
        $('#zaregistruj').click(function (e) {
            if ($('#registracia')[0].checkValidity()) {
                e.preventDefault();
                var chyba = document.getElementById("hlaska");
                if (chyba != null) {
                    chyba.remove();
                }
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
</script>
</body>
</html>