//JSON data
let jsonData;
let jsonTeam;

function loadMatch() {
	//Skapa ett anslutnings objekt
    var xhttp = new XMLHttpRequest();

    //Välj fil att ansluta till
    xhttp.open("POST", "php/getMatchInfo.php", true);
    //POST typ
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("id=-1");

    //Vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar fås
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonData = this.responseText;
            
            //Kolla ifall svaret innehåller error
            if ( jsonData.includes('fel') ) {
                window.location.href = "php/error.php?error-msg=Fel vid hämtning av lag!";
            }

            //Gör om svaret till JSON
            jsonData = JSON.parse(jsonData);
            console.log(jsonData);
            showMatch();
        }        
    };
	
}
function loadTeam(num1, num2) {
    //Skapa ett anslutnings objekt
    var xhttp = new XMLHttpRequest();

    //Välj fil att ansluta till
    xhttp.open("POST", "php/getDuoTeamInfo.php", true);
    //POST typ
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("team-one-id=" + num1 + "&team-two-id=" + num2);

    //Vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonTeam = this.responseText;
            
            //Kolla ifall svaret innehåller error
            if ( jsonData.includes('fel') ) {
                window.location.href = "php/error.php?error-msg=Fel vid hämtning av match!";
            }

            //Gör om svaret till JSON
            jsonTeam = JSON.parse(jsonData);

            
        }
    };
}

function showMatch() {
    //Töm alla containrar
    $(".team-container").empty();

    //Gå igenom alla matcher och kolla ifall de är avklarde eller inte
    for (var i = 0; i < jsonData.length; i++) {
        //Kolla ifall matchen är klar eller inte
        var done = jsonData[i].done;

        //Skirv ut där matchen är klar
        if (done == 1) {
        
        } 
        //Skriv ut där matchen inte är klar
        else {

        }

    }
}






