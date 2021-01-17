<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmazanie účtu</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="zmazanieUctuScript.js"></script>
</head>
<body>
<div class="divHlavicka">
    <?php
    include "../menu.php";
    ?>
    <p>To je škoda :(. Ak skutočne chcete zmazať svoj účet, potvrďte voľbu dole.</p>
</div>
<form class="formular" method="post" id="zmazUcet">
    <input name="heslo" id="heslo" placeholder="Heslo" type="password" required><br><br>
    <input class="button" name="zmaz" id="zmaz" type="submit" value="Zmaž účet">
</form>
</body>
</html>