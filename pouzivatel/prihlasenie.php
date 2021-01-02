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
    <title>Prihlásenie</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="divHlavicka">
    <img class="nadpis" src="../obrazky/nadpis.JPG">
</div>
<div class="formular">
    <h2>Je potrebné prihlásenie, zadajte svoje meno a heslo.</h2>
    <form class="formular" id="login" method="post">
        <input name="meno" id="meno" placeholder="Login" type="text" required><br><br>
        <input name="heslo" id="heslo" placeholder="Heslo" type="password" required><br><br>
        <input class="button" name="prihlas" id="prihlas" type="submit" value="Prihláste sa!">
    </form>
    Ešte nemáte vytvorený účet? <a href="registracia.php"><b>Zaregistrujte sa!</b></a>
</div>
<script>
    $(document).ready(function () {
        $('#prihlas').click(function (e) {
            if ($('#login')[0].checkValidity()) {
                e.preventDefault();
                var chyba = document.getElementById("hlaska");
                if (chyba != null) {
                    chyba.remove();
                }
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
</script>
</body>
</html>
