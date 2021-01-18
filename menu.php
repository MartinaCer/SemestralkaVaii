<?php
require_once "pripojenie.php";
if (!isset($_SESSION["meno"])) {
    header("Location: ../pouzivatel/prihlasenie.php");
}
?>
<div id="navigacia" class="menu">
    <a href="javascript:void(0)" class="menuZavri" onclick="zavriMenu()">&times;</a>
    <a href="../produkty/produkty.php">Produkty</a>
    <a href="../kosik/kosik.php">Košík</a>
    <a href="../historia/historia.php">História objednávok</a>
    <a href="../pouzivatel/zmenaHesla.php">Zmena hesla</a>
    <a href="../pouzivatel/zmazanieUctu.php">Zmazanie účtu</a>
    <a id="admin" href="../admin/administrator.php">Administrátor</a>
</div>
<span class="menuIkona" onclick="zobrazMenu()">&#9776; MENU</span>
<img class="nadpis" src="../obrazky/nadpis.JPG" alt="nadpis"><br>
<a href="../pouzivatel/odhlasenie.php"><img class="menuOdhlas" src="../obrazky/odhlasenie.png" alt="odhlasenie"></a>
<script>
    window.onload = function () {
        var admin = <?php echo $_SESSION["admin"];?>;
        if (admin == 0) {
            var x = document.getElementById("admin");
            x.style.visibility = "hidden";
        }
    };

    function zobrazMenu() {
        document.getElementById("navigacia").style.width = "20%";
        document.getElementById("navigacia").style.border = "3px outset blue";
    }

    function zavriMenu() {
        document.getElementById("navigacia").style.width = "0";
        document.getElementById("navigacia").style.border = "0px";
    }
</script>