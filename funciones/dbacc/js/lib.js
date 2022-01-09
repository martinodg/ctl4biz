function popularDb() {
    $.getJSON('api/index.php', 'dbs', function (result) {
        for (let i = 0; i < result.length; i++) {
            let elem = $("<option></option>");
            elem.attr("value", result[i].nombre);
            elem.text(result[i].nombre);
            elem.appendTo($("select#companyIds"));
        }
    });
}

function submitForm(event) {
    event.preventDefault();
    $.post("api/index.php?q",
        $("#frmQuery").serialize(),
        function (menssge) {
            formSuccess(menssge);
        });
}

function formSuccess(message) {
    $("#msg").html(message).removeClass("hidden");
}

$(document).ready(function () {
    popularDb();
    $("#frmQuery").on("submit", submitForm);
});
