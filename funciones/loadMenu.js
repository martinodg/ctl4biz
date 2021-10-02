//loadMenu();
function loadLocalMenu() {
   
    $(document).ready(function() {  
        $("#resources_menu").show();
        });
        // This check if works on all devices/browsers, and uses IndexedDBShim as a final fallback 
        var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        //open old Ctl4bizLDB
        var oldCTLDB = new Localbase('Ctl4bizLDB');
        //delete old database with old data
        oldCTLDB.delete() .then(response => {
            console.log('Database deleted, now do something.')
          })
          .catch(error => {
            console.log('There was an error, do something else.')
          })
        //Bring data from remote relational Data Base
        $.getJSON("./funciones/BackendQueries/getAllAllowedMenuItems.php", function(data) { 
                                                                                            // Create a fresh local database
                                                                                            
                                                                                            let CTLDB = new Localbase('Ctl4bizLDB');
                                                                                            const obj = JSON.parse(data);   //parse data from relational DB  
                                                                                            var lastTurn=obj.length;
                                                                                            var dbTurn=0;
                                                                                            var docKey=1;
                                                                                            for(var key in obj){
                                                                                                     if(obj.hasOwnProperty(key)) {
                                                                                                            var indata=JSON.stringify(obj[key]);
                                                                                                            var parsed= JSON.parse(indata);
                                                                                                           
                                                                                                            // Put some data into it
                                                                                                            
                                                                                                            CTLDB.collection('menu').add(parsed,docKey)
                                                                                                            .then(response => {
                                                                                                              dbTurn++;
                                                                                                              
                                                                                                              if(dbTurn==lastTurn){ 
                                                                                                                                    window.top.location = "./index.php";

                                                                                                                                  }

                                                                                                            })
                                                                                                            docKey++;
                                                                                                            
                                                                                                            
                                                                                                      } 
                                                                                            } 
                                                                                           
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
        });  

                                                                                                                                                   
}