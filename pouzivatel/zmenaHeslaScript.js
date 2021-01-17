$(document).ready(function () {
    $('#zmenaHesla').click(function (e) {
        var hlaska = document.getElementById("hlaska");
        if (hlaska != null) {
            hlaska.remove();
        }
        if ($('#zmenaHesla')[0].checkValidity()) {
            e.preventDefault();
            var stare = $('#stare').val();
            var nove = $('#nove').val();
            var noveKontrola = $('#noveKontrola').val();
            $.ajax
            ({
                type: "POST",
                url: "zmenaHeslaAjax.php",
                data: {"stare": stare, "nove": nove, "noveKontrola": noveKontrola},
                success: function (data) {
                    $("<div id='hlaska'>" + data + "</div>").appendTo("body");
                }
            });
        }
    });
});