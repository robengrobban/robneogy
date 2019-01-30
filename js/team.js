/*
 * KRAV FÖR DENNA FIL ÄR ATT JQUERY MÅSTE LADDAS IN INNAN DENNA FIL
*/

//Variabel för team.js filen
let jsonData;

//Funktion för att ladda lag
//str String, lagnamnet som ska sökas
//num int, id för laget som ska skapa matchen
function loadTeam( str , num) {
    //Skapa ett anslutnings objekt
    var xhttp = new XMLHttpRequest();

    //Välj fil att ansluta till
    xhttp.open("POST", "php/getTeamInfo.php", true);
    //POST typ
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("team-id=" + num + "&search-team=" + str.trim());

    //Vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonData = this.responseText;
            
            //Kolla ifall svaret innehåller error
            if ( jsonData.includes('fel') ) {
                window.location.href = "php/error.php?error-msg=Fel vid hämtning av lag!";
            }

            //Gör om svaret till JSON
            jsonData = JSON.parse(jsonData);

            //Skirv ut svaret
            printTeam(jsonData);
        }
    };
}

//Skriver ut lagen i listan
//jsonData JSON, json som ska användas
function printTeam( jsonData ) {
    //Töm den befintliga listan
    $("form #search-container ul").empty();
    
    //Gå igenom alla rader med JSON data
    for ( var i = 0; i < jsonData.length; i++ ) {
        //Hämta list hanteraren
        var dom = $("form #search-container ul").eq(0);

        //Hämta lag namn
        var lagNamn = jsonData[i].name;

        //Lägg till
        dom.append("<li><a class='team-"+i+"' onclick='selectTeam(jsonData, "+i+", this)'>"+lagNamn+"</a></li>");
    }
}

//Välj ett lag och skriv in lagnamnet i sök rutan
//jsonData JSON, datan som ska användas
//num int, index ID för JSON datan
//dom DOM, elementet som klickades
function selectTeam( jsonData, num, dom ) {
    //Hämta namnet för elementet som klickades
    var lagNamn = dom.innerHTML;

    //Ändra input rutans text till lagets namn
    $("form #search-container [name='search-team']")[0].value = lagNamn;
}

