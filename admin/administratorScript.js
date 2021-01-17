$(document).ready(function () {
    const pridajProduktModal = document.getElementById("pridajProduktModal");
    const vymazProduktModal = document.getElementById("vymazProduktModal");
    const upravProduktModal = document.getElementById("upravProduktModal");
    document.getElementById("pridajProdukt").onclick = function () {
        pridajProduktModal.style.display = "block";
    }
    document.getElementsByClassName("modalZavri")[0].onclick = function () {
        pridajProduktModal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == pridajProduktModal) {
            pridajProduktModal.style.display = "none";
        }
        if (event.target == vymazProduktModal) {
            vymazProduktModal.style.display = "none";
        }
        if (event.target == upravProduktModal) {
            upravProduktModal.style.display = "none";
        }
    }
    document.getElementById("tabulka").style.visibility = "hidden";
    $("#pouzivatelia").click(function () {
        $("#tabulka thead").empty();
        $("#tabulka tbody").empty();
        $.ajax({
            url: 'administratorAjax.php',
            type: "GET",
            data: {
                operacia: 1
            },
            dataType: 'json',
            success: function (data) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    var riadok = "<tr>" +
                        "<td>" + data[i].meno + "</td>" +
                        "<td>" + data[i].mail + "</td>" +
                        "<td>" + data[i].telefon + "</td>" +
                        "<td>" + data[i].registracia + "</td>" +
                        "<td>" + data[i].admin + "</td>" +
                        "</tr>";
                    $("#tabulka tbody").append(riadok);
                }
            }
        });
        document.getElementById("tabulka").style.visibility = "visible";
        var hlavicka = "<tr>" +
            "<th> Používateľ </th>" +
            "<th> E-mail </th>" +
            "<th> Telefónne číslo </th>" +
            "<th> Dátum registrácie </th>" +
            "<th> Je administrátor </th>" +
            "</tr>";
        $("#tabulka thead").append(hlavicka);
    });
    $("#objednavky").click(function () {
        $("#tabulka thead").empty();
        $("#tabulka tbody").empty();
        $.ajax({
            url: 'administratorAjax.php',
            type: "GET",
            data: {
                operacia: 2
            },
            dataType: 'json',
            success: function (data) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    var riadok = "<tr>" +
                        "<td>" + data[i].meno + "</td>" +
                        "<td>" + data[i].datum + "</td>" +
                        "<td>" + data[i].pocet + "</td>" +
                        "<td>" + data[i].suma + "</td>" +
                        "</tr>";
                    $("#tabulka tbody").append(riadok);
                }
            }
        });
        document.getElementById("tabulka").style.visibility = "visible";
        var hlavicka = "<tr>" +
            "<th> Používateľ </th>" +
            "<th> Dátum nákupu </th>" +
            "<th> Počet položiek </th>" +
            "<th> Celková suma </th>" +
            "</tr>";
        $("#tabulka thead").append(hlavicka);
    });
    $("#produkty").click(function () {
        $("#tabulka thead").empty();
        $("#tabulka tbody").empty();
        $.ajax({
            url: 'administratorAjax.php',
            type: "GET",
            data: {
                operacia: 3
            },
            dataType: 'json',
            success: function (data) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    var riadok = "<tr id=" + data[i].id + ">" +
                        "<td>" + data[i].meno + "</td>" +
                        "<td>" + data[i].obrazok + "</td>" +
                        "<td>" + data[i].cena + "</td>" +
                        "<td>" + data[i].pocet + "</td>" +
                        "<td>" + data[i].akcia + "</td>" +
                        "</tr>";
                    $("#tabulka tbody").append(riadok);
                }
            }
        });
        document.getElementById("tabulka").style.visibility = "visible";
        var hlavicka = "<tr>" +
            "<th> Názov produktu </th>" +
            "<th> Súbor s obrázkom </th>" +
            "<th> Cena produktu </th>" +
            "<th> Počet predaných kusov </th>" +
            "<th></th>" +
            "</tr>";
        $("#tabulka thead").append(hlavicka);
    });
});

function vymazProdukt() {
    idProduktu = event.target.parentNode.parentNode.id;
    hiddenPole = "<input type='hidden' name='idProduktuVymaz' value=" + idProduktu + "/>";
    $('#vymazFormModal').append(hiddenPole);
    document.getElementById("vymazProduktModal").style.display = "block";
}

function upravProdukt() {
    document.getElementById("upravFormModal").innerHTML = "";
    idProduktu = event.target.parentNode.parentNode.id;
    nazov = document.getElementById(idProduktu).childNodes[0].textContent;
    obrazok = document.getElementById(idProduktu).childNodes[1].textContent;
    cena = document.getElementById(idProduktu).childNodes[2].textContent.match(/\d/g).join("");
    hiddenPole = "<input type='hidden' name='idProduktuUprav' value=" + idProduktu + "/>";
    labelNazov = "<label for='nazov'>Názov produktu</label><br>";
    nazovPole = "<input type='text' name='nazov' id='nazov' value='" + nazov + "'required><br><br>";
    labelObrazok = "<label for='obrazok'>Súbor s obrázkom produktu (nemusí byť zadaný)</label><br>";
    obrazokPole = "<input type='text' name='obrazok' id='obrazok' value=" + obrazok + "><br><br>";
    labelCena = "<label for='cena'>Cena produktu</label><br>";
    cenaPole = "<input type='number' name='cena' min='1' id='cena' value='" + cena + "'required><br><br>";
    submitTlacidlo = "<input type='submit' value='Áno, chcem upraviť produkt!' name='anoUprav' id='anoUprav' class='button'>";
    $('#upravFormModal').append(hiddenPole, labelNazov, nazovPole, labelObrazok, obrazokPole, labelCena, cenaPole, submitTlacidlo);
    document.getElementById("upravProduktModal").style.display = "block";
}