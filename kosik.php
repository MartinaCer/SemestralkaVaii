<?php
require_once "pripojenie.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>Vo vašom nákupnom košíku máte nasledovné produkty. Môžete buď pokračovať v nákupe alebo objednávku uzavrieť.</p>
</div>
<?php
include "menu.php";
?>
<?php
echo $_SESSION["kosik"]["1"];
?>
</body>
</html>