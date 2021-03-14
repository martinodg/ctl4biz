$(document).ready(function() {
    var  lang = getLanguajeIndex();
    if (lang == ""); {
        setTranslation(0);
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
    }
    if (lang == "1") {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
    }
    if (lang == "2") {
        $("#bandera_lengua").attr("src", "../img/polish-language.svg");
    }

    //change language
    $("#espanol").click(function() {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
        $("#language").val("1");
        setTranslation(1);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#english").click(function() {
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
        $("#language").val("0");
        setTranslation(0);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#polish").click(function() {
        $("#bandera_lengua").attr("src", "../img/polish-language.svg");
        $("#language").val("2");
        setTranslation(2);
        lang = getLanguajeIndex();
        langchange(lang);
    });
});