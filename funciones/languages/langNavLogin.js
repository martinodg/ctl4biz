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
    if (lang == "3") {
        $("#bandera_lengua").attr("src", "../img/italiano-language.svg");
    }
    if (lang == "4") {
        $("#bandera_lengua").attr("src", "../img/portugues-language.svg");
    }
    if (lang == "5") {
        $("#bandera_lengua").attr("src", "../img/francais-language.svg");
    }
    if (lang == "6") {
        $("#bandera_lengua").attr("src", "../img/deutsche-language.svg");
    }

    //change language
    $("#english").click(function() {
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
        $("#language").val("0");
        setTranslation(0);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#espanol").click(function() {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
        $("#language").val("1");
        setTranslation(1);
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
    $("#italiano").click(function() {
        $("#bandera_lengua").attr("src", "../img/italiano-language.svg");
        $("#language").val("3");
        setTranslation(3);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#portugues").click(function() {
        $("#bandera_lengua").attr("src", "../img/portugues-language.svg");
        $("#language").val("4");
        setTranslation(4);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#francais").click(function() {
        $("#bandera_lengua").attr("src", "../img/francais-language.svg");
        $("#language").val("5");
        setTranslation(5);
        lang = getLanguajeIndex();
        langchange(lang);
    });
    $("#deutsche").click(function() {
        $("#bandera_lengua").attr("src", "../img/deutsche-language.svg");
        $("#language").val("6");
        setTranslation(6);
        lang = getLanguajeIndex();
        langchange(lang);
    });
});