<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmena hesla</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>Zmena hesla! Môžete si zmeniť heslo do vášho účtu.</p>
</div>
<?php
include "menu.php";
?>
<form action="#" class="formular" id="zmenaHesla" method="post">
    <input id="stare" placeholder="Pôvodné heslo" type="password"><br><br>
    <input id="nove" placeholder="Nové heslo" type="password"><br><br>
    <input id="noveKontrola" placeholder="Kontrola hesla" type="password"><br><br>
    <input class="button" id="zmenHeslo" type="submit" value="Zmeň heslo!">
</form>
</body>
</html>