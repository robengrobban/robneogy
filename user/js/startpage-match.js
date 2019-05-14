//JSON data
let jsonMatch;
let jsonTeam;

//Dynamisk laddning
let laddning;
let laddningsTidSekunder = 60; //Sekunder

function startMatchLoad() {
	laddning = setInterval(loadMatch, (laddningsTidSekunder * 1000));
}
function stopMatchLoad() {
	clearInterval(laddning);
}

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
            jsonMatch = this.responseText;

            //Gör om svaret till JSON
            jsonMatch = JSON.parse(jsonMatch);

            //Ladda lagen
            loadTeam();
        }
    };

}
function loadTeam() {
    //Skapa ett anslutnings objekt
    var xhttp = new XMLHttpRequest();

    //Välj fil att ansluta till
    xhttp.open("POST", "php/getAllTeamInfo.php", true);
    //POST typ
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("confirm=true");

    //Vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonTeam = this.responseText;

            //Gör om svaret till JSON
            jsonTeam = JSON.parse(jsonTeam);

            //Visa matcher
            showMatch();
        }
    };
}

function showMatch() {
    //Töm alla containrar
    $(".team-container").empty();

    //Gå igenom alla matcher och kolla ifall de är avklarde eller inte
    for (var i = 0; i < jsonMatch.length; i++) {
        //Kolla ifall matchen är klar eller inte
        var done = jsonMatch[i].done;

        var teamOneId = jsonMatch[i].teamIdOne;
        var teamTwoId = jsonMatch[i].teamIdTwo;

        var teamOneName = getName(jsonTeam, teamOneId);
        var teamTwoName = getName(jsonTeam, teamTwoId);

        //Skirv ut där matchen är klar
        if (done == 1) {
            var dom = $("#completed-matches .team-container ");
        }
        //Skriv ut där matchen inte är klar
        else {
            var dom = $("#upcoming-matches .team-container");
        }
        dom.append('<div onclick="openMatch('+jsonMatch[i].id+')"><p><span class="team-one">'+teamOneName+'</span><span class="team-vs">VS</span><span class="team-two">'+teamTwoName+'</span></p></div>');

    }
}
