//JSON data
let jsonData;

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

        }        
    };
	
}

function showMatch() {
    //Töm alla containrar
    



}






