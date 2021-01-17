<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmena hesla</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="zmenaHeslaScript.js"></script>
</head>
<body>
<div class="divHlavicka">
    <?php
    include "../menu.php";
    ?>
    <p>Zmena hesla! Môžete si zmeniť heslo do vášho účtu.</p>
</div>
<form class="formular" id="zmenaHesla" method="post">
    <input id="stare" name="stare" placeholder="Pôvodné heslo" type="password" required><br><br>
    <input id="nove" name="nove" placeholder="Nové heslo" type="password" required><br><br>
    <input id="noveKontrola" name="noveKontrola" placeholder="Kontrola hesla" type="password" required><br><br>
    <input class="button" id="zmenHeslo" name="zmenHeslo" type="submit" value="Zmeň heslo!">
</form>
</body>
</html>
