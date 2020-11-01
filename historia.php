<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>História objednávok</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>Tu môžete vidieť prehľad vašich minulých nákupov v našom obchode.</p>
</div>
<?php
include "menu.php";
if (!isset($_SESSION["meno"])) {
    header("Location: prihlasenie.php");
}
$id = $_SESSION["id"];
$selectHistoria = "select * from historia where IDpouzivatel='" . $id . "'";
$historia = mysqli_query($mysqli, $selectHistoria);
?>
<table>
    <thead>
    <tr>
        <th>Celková suma</th>
        <th>Dátum</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($riadok = $historia->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $riadok["suma"] . " €"; ?></td>
            <td><?php echo $riadok["datum"]; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>