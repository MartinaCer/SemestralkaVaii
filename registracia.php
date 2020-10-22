<?php
require_once "pripojenie.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrácia</title>
        <link href="styly.css" rel="stylesheet">
    </head>
    <body>
    <div class="divHlavicka">
        <h1>Najlepší e-shop</h1>
    </div>
    <div class="formular">
        <h2>Vytvorte si nový účet.</h2>
        <form class="formular" id="registracia" method="post">
            <input name="meno" id="meno" placeholder="Login" type="text"><br><br>
            <input name="heslo" id="heslo" placeholder="Heslo" type="password"><br><br>
            <input class="button" name="zaregistruj" id="zaregistruj" type="submit" value="Zaregistruj sa!">
        </form>
        Už máte účet? <a href="prihlasenie.php"><b>Prihláste sa!</b></a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST["zaregistruj"])) {
    $meno = mysqli_real_escape_string($mysqli, $_POST["meno"]);
    $heslo = mysqli_real_escape_string($mysqli, $_POST["heslo"]);
    $hashHeslo = password_hash($heslo, PASSWORD_DEFAULT);
    if ($meno != "" && $heslo != "") {
        $query = "select count(*) as pocet from pouzivatel where meno='" . $meno . "'";
        $vysledok = mysqli_query($mysqli, $query);
        $riadok = mysqli_fetch_array($vysledok);
        $pocet = $riadok["pocet"];
        if ($pocet == 0) {
            $insert = "insert into pouzivatel(meno, heslo) values ('$meno', '$hashHeslo')";
            mysqli_query($mysqli, $insert);
            header("Location: prihlasenie.php");
        } else
            echo "<script type='text/javascript'>alert('\"Toto meno sa uz používa!\"');</script>";
    }
}
?>