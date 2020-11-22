<?php
require_once "pouzivatelFunkcie.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prihlásenie</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <img class="nadpis" src="obrazky/nadpis.JPG">
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
</body>
</html>

<?php
if (isset($_POST["prihlas"])) {
    prihlas(mysqli_real_escape_string($mysqli, $_POST["meno"]), mysqli_real_escape_string($mysqli, $_POST["heslo"]), $mysqli);
}
?>
