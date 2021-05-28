//this function calculate the pagination segments 
function calculaPaginacion() {
    var paginas = document.getElementById("paginas").value
    if (paginas == 0) {
        $("#paginas").empty();
        var inicio = 0;
        var fin = 10;
        var text = inicio + "-" + fin;
        var value = 1;
        var newNroLineas = document.getElementById("nroLineas").value;
        document.getElementById("filas").value = newNroLineas;

        var nrOpciones = (newNroLineas / 10);
        var ultimoNr = 10;
        while (nrOpciones > 0) {

            text = (inicio + 1) + "-" + fin;

            $("#paginas").append($("<option />").val(inicio).text(text));
            nrOpciones--;
            inicio = (inicio + 10);
            fin = (fin + 10);

        }
    }
}
//---------------------------------------------------------------------------------------------------