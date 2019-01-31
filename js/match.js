/*
 * KRAV FÖR DENNA FIL ÄR ATT JQUERY MÅSTE LADDAS IN INNAN DENNA FIL
*/

//variabel för match.js filen
let jsonData;
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
            jsonData = this.responseText;
            
            //Kolla ifall svaret innehåller error
            if ( jsonData.includes('fel') ) {
                window.location.href = "php/error.php?error-msg=Fel vid hämtning av match!";
            }

            //Gör om svaret till JSON
            jsonData = JSON.parse(jsonData);

            
            //kolla jsonData
            console.log(jsonData);

            hamtaLagnamn(jsonData[0].teamIdOne,jsonData[0].teamIdTwo);


        }
    };
	
	//hämta lagnamn.


}


function hamtaLagnamn(lagIdEtt, lagIdTva){
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
            
            //Kolla ifall svaret innehåller error
            if ( jsonLag.includes('fel') ) {
                window.location.href = "php/error.php?error-msg=Fel vid hämtning av lagnamn!";
            }

            //Gör om svaret till JSON
            jsonLag = JSON.parse(jsonLag);
            console.log(jsonLag);

            showMatchInfo();

        }
    };




}

//hämtar matchdata och skriver ut
function showMatchInfo(){

	//hämtar lag 1 o 2
	var teamOneName = getName(jsonLag, jsonData[0].teamIdOne);
	var teamTwoName = getName(jsonLag, jsonData[0].teamIdTwo);

	console.log(teamOneName+ " " +teamTwoName);



	$("#match-container #team-one .team-name").text(teamOneName);
	$("#match-container #team-two .team-name").text(teamTwoName);

	$("#match-container #team-one .vote-container .votes").text(jsonData[0].votesTeamOne);
	$("#match-container #team-two .vote-container .votes").text(jsonData[0].votesTeamTwo);

	var teamOneRoster = jsonData[0].votesTeamOne;
	var teamTwoRoster = jsonData[0].votesTeamTwo;

	var diff = teamOneRoster / teamTwoRoster;
	var pro = diff*100;
	if(diff == 1){
		pro = 50;
	}

	$("#progress-value").css("width", pro+"%");

}

