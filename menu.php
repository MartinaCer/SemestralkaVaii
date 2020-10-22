<?php
require_once "pripojenie.php";
?>
<ul class="menu">
    <li class="menuStranka"><a class="menuFont" href="produkty.php">Produkty</a></li>
    <li class="menuStranka"><a class="menuFont" href="kosik.php">Košík</a></li>
    <li class="menuStranka"><a class="menuFont" href="historia.php">História objednávok</a></li>
    <li class="menuStranka"><a class="menuFont" href="odhlasenie.php">Odhlásenie</a></li>
    <li class="menuStranka"><a class="menuFont" href="zmenaHesla.php">Zmena hesla</a></li>
    <li class="menuStranka"><a class="menuFont" href="zmazanieUctu.php">Zmazanie účtu</a></li>
    <li id="admin" class="menuStranka"><a class="menuFont" href="administrator.php">Administrátor</a></li>
</ul>
<script>
    window.onload = function () {
        var x = document.getElementById("admin");
        x.style.visibility = "hidden";
    };
</script>
