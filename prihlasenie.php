<?php
require_once "pripojenie.php";
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
    $meno = mysqli_real_escape_string($mysqli, $_POST["meno"]);
    $heslo = mysqli_real_escape_string($mysqli, $_POST["heslo"]);
    if ($meno != "" && $heslo != "") {
        $selectMeno = "select count(*) as pocet from pouzivatel where meno='" . $meno . "'";
        $vysledok = mysqli_query($mysqli, $selectMeno);
        $riadok = mysqli_fetch_array($vysledok);
        $pocet = $riadok["pocet"];
        if ($pocet > 0) {
            $selectHeslo = "select * from pouzivatel where meno='" . $meno . "'";
            $vysledok1 = mysqli_query($mysqli, $selectHeslo);
            $riadok1 = mysqli_fetch_array($vysledok1);
            $hashHeslo = $riadok1["heslo"];
            if (password_verify($heslo, $hashHeslo)) {
                $_SESSION["meno"] = $meno;
                $_SESSION["id"] = $riadok1["ID"];
                $_SESSION["admin"] = $riadok1["admin"];
                header("Location: produkty.php");
            } else {
                echo "<h2>Zadali ste nesprávne heslo!</h2>";
            }
        } else {
            echo "<h2>Zadali ste nesprávne meno!</h2>";
        }
    }
}
?>
