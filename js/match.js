/*
 * KRAV FÖR DENNA FIL ÄR ATT JQUERY MÅSTE LADDAS IN INNAN DENNA FIL
*/

//variabel för match.js filen
let jsonMatch;
let jsonLag;

//Funktion för att ladda match
//num int, id för den specifika matchen

function loadMatch(num){
	//skapa ett anslutnings objekt
	var xhttp = new XMLHttpRequest();

	//välj fil att ansluta till
	xhttp.open("POST", "php/getMatchInfo.php", true);
	//post, typ
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("id=" +num);

    //vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonMatch = this.responseText;

            //Gör om svaret till JSON
            jsonMatch = JSON.parse(jsonMatch);

			//Hämta lag information
            loadTeam(jsonMatch[0].teamIdOne,jsonMatch[0].teamIdTwo);

        }
    };

}


function loadTeam(lagIdEtt, lagIdTva){
	//Skapa ett anslutnings objekt
    var xhttp = new XMLHttpRequest();

    //Välj fil att ansluta till
    xhttp.open("POST", "php/getDuoTeamInfo.php", true);
    //POST typ
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("team-one-id=" + lagIdEtt + "&team-two-id=" +lagIdTva);

    //Vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonLag = this.responseText;

            //Gör om svaret till JSON
            jsonLag = JSON.parse(jsonLag);

			//Skriv ut informationen till skärmen
            showMatchInfo();

        }
    };

}

//hämtar matchdata och skriver ut
function showMatchInfo(){

	//hämtar lag 1 o 2
	var teamOneName = getName(jsonLag, jsonMatch[0].teamIdOne);
	var teamTwoName = getName(jsonLag, jsonMatch[0].teamIdTwo);

	//Skirv ut informationen till skärmen
	$("#match-container #team-one .team-name").text(teamOneName);
	$("#match-container #team-two .team-name").text(teamTwoName);
	$("#match-container #choose-winner #team-one-name").text(teamOneName);
	$("#match-container #choose-winner #team-two-name").text(teamTwoName);

	$("#match-container #team-one .vote-container .votes").text(jsonMatch[0].votesTeamOne);
	$("#match-container #team-two .vote-container .votes").text(jsonMatch[0].votesTeamTwo);

	//Räkna ut och skriv fram röster
	var teamOneRoster = jsonMatch[0].votesTeamOne;
	var teamTwoRoster = jsonMatch[0].votesTeamTwo;

	//Räkna ut totalen och differansen
	var tot = teamOneRoster + teamTwoRoster;
	var diff = teamOneRoster / tot;

	//Räkna ut procenten av den differansen
	var pro = diff*100;

	//Ändra stilen på progress-value så man ser progressbaren
	$("#progress-value").css("width", pro+"%");

	//Ändra stil ifall ett lag van
	if ( jsonMatch[0].done == 1 ) {

		//Kolla ifall lag ett vann
		if ( jsonMatch[0].teamIdOne == jsonMatch[0].winnerId ) {
			$("#match-container #team-one .team-name").css("background-color", "green");
			$("#match-container #team-two .team-name").css("background-color", "red");
		}
		//Annars vann andra laget
		else {
			$("#match-container #team-two .team-name").css("background-color", "green");
			$("#match-container #team-one .team-name").css("background-color", "red");
		}

	}

}
