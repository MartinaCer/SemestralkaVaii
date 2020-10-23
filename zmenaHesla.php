<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmena hesla</title>
    <link href="styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>Zmena hesla! Môžete si zmeniť heslo do vášho účtu.</p>
</div>
<?php
include "menu.php";
?>
<form class="formular" id="zmenaHesla" method="post">
    <input id="stare" name="stare" placeholder="Pôvodné heslo" type="password"><br><br>
    <input id="nove" name="nove" placeholder="Nové heslo" type="password"><br><br>
    <input id="noveKontrola" name="noveKontrola" placeholder="Kontrola hesla" type="password"><br><br>
    <input class="button" id="zmenHeslo" name="zmenHeslo" type="submit" value="Zmeň heslo!">
</form>
<script>
    $(document).ready(function () {
        $('#zmenHeslo').click(function (e) {
            e.preventDefault();
            var stare = $('#stare').val();
            var nove = $('#nove').val();
            var noveKontrola = $('#noveKontrola').val();
            $.ajax
            ({
                type: "POST",
                url: "zmenaHesla.php",
                data: {"stare": stare, "nove": nove, "noveKontrola": noveKontrola},
                success: function (data) {
                    $('.result').html(data);
                    $('#zmenaHesla')[0].reset();
                }
            });
        });
    });
</script>
</body>
</html>
<?php
if (isset($_POST["stare"])) {
    $stare = $_POST["stare"];
    $nove = $_POST["nove"];
    $noveKontrola = $_POST["noveKontrola"];
    $selectPouzivatel = "select heslo from pouzivatel where meno ='" . $_SESSION["meno"] . "'";
    $riadok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectPouzivatel));
    if (password_verify($stare, $riadok["heslo"])) {
        if ($nove == $noveKontrola) {
            $hashNoveHeslo = password_hash($nove, PASSWORD_DEFAULT);
            $updateHeslo = "update pouzivatel set heslo='" . $hashNoveHeslo . "' where meno ='" . $_SESSION["meno"] . "'";
            mysqli_query($mysqli, $updateHeslo);
            echo "<div class='formular'>Heslo bolo zmenené.</div>";
        } else {
            echo "<div class='formular'>Heslá sa nezhodujú.</div>";
        }
    } else {
        echo "<div class='formular'>Zadali ste nesprávne heslo.</div>";
    }
}
