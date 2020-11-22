<?php
require_once "pouzivatelFunkcie.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrácia</title>
        <link href="styly.css" rel="stylesheet">
    </head>
    <body>
    <div class="divHlavicka">
        <img class="nadpis" src="obrazky/nadpis.JPG">
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
    </body>
    </html>

<?php
if (isset($_POST["zaregistruj"])) {
    registruj(mysqli_real_escape_string($mysqli, $_POST["meno"]), mysqli_real_escape_string($mysqli, $_POST["heslo"]),
        mysqli_real_escape_string($mysqli, $_POST["hesloKontrola"]), mysqli_real_escape_string($mysqli, $_POST["email"]),
        mysqli_real_escape_string($mysqli, $_POST["telefon"]), $mysqli);
}
?>