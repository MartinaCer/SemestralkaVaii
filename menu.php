<?php
require_once "pripojenie.php";
require_once "pouzivatelFunkcie.php";
require_once "nakupFunkcie.php";
if (!isset($_SESSION["meno"])) {
    header("Location: prihlasenie.php");
}
?>
<div id="navigacia" class="menu">
    <a href="javascript:void(0)" class="menuZavri" onclick="zavriMenu()">&times;</a>
    <a href="produkty.php">Produkty</a>
    <a href="kosik.php">Košík</a>
    <a href="historia.php">História objednávok</a>
    <a href="zmenaHesla.php">Zmena hesla</a>
    <a href="zmazanieUctu.php">Zmazanie účtu</a>
    <a id="admin" href="administrator.php">Administrátor</a>
</div>
<span class="menuIkona" onclick="zobrazMenu()">&#9776; MENU</span>
<img class="nadpis" src="obrazky/nadpis.JPG"><br>
<a href="odhlasenie.php"><img class="menuOdhlas" src="obrazky/odhlasenie.png"></a>
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