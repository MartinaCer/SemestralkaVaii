<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmazanie účtu</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <?php
    include "menu.php";
    ?>
    <p>To je škoda :(. Ak skutočne chcete zmazať svoj účet, potvrďte voľbu dole.</p>
</div>
<form class="formular" method="post">
    <input name="heslo" placeholder="Heslo" type="password" required><br><br>
    <input class="button" name="zmaz" type="submit" value="Zmaž účet">
</form>
</body>
</html>
<?php if (isset($_POST["zmaz"])) {
    zmazUcet($_POST["heslo"], $mysqli);
}