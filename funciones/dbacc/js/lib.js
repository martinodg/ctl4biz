function popularDb() {
    $.getJSON('api/index.php', 'dbs', function (result) {
        for (let i = 0; i < result.length; i++) {
            let elem = $("<option></option>");
            elem.attr("value", result[i].id);
            elem.text(result[i].nombre);
            elem.appendTo($("select#companyIds"));
        }
    });
}

function submitForm(event) {
    event.preventDefault();
    $.post("api/index.php?q",
        $("#frmQuery").serialize(),
        function (jsonRows) {
            const dl = $("#msg > dl");
            dl.empty();
            jQuery.each(jsonRows, function (ind, jsonRow) {
                console.info(jsonRow);
                let dt = $("<dt></dt>");
                dt.text(jsonRow.dql);
                dt.appendTo(dl);
                let dd = $("<dd></dd>");
                dd.text(JSON.stringify(jsonRow.response));
                dd.appendTo(dl);
            });
            $("#msg").show();
        }, 'json');
}

$(document).ready(function () {
    popularDb();
    $("#frmQuery").on("submit", submitForm);
});
