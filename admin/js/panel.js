function loadAccount( str ) {
	//skapa ett anslutnings objekt
	var xhttp = new XMLHttpRequest();

	//välj fil att ansluta till
	xhttp.open("POST", "php/getAccountInfo.php", true);
	//post, typ
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("username="+str);

    //vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            var resp = this.responseText;

            //Gör om svaret till JSON
            var json = JSON.parse(resp);

			//Visa resultat
			displayAccount(json);

        }
    };
}

function displayAccount(json) {
	console.log(json);
	//Töm listan
	var dom = $("#search-account tbody").empty();

	for ( var i = 0; i < json.length; i++) {
		var info = json[i];

		var id = info.id;
		var username = info.username;
		var mail = info.mail;
		var firstname = info.firstname;
		var lastname = info.lastname;
		var teamId = info.teamId;
		var imageURL = info.imageURL;
		var ban = info.ban;

		//Fixa värden som kan vara null
		if ( teamId == null ) {
			teamId = "";
		}
		if ( imageURL == null ) {
			imageURL = "";
		}

		dom.append("<tr>"+
			"<td><a target='_blank' href='viewUser.php?id="+id+"'>"+id+"</a></td>"+
			"<td>"+username+"</td>"+
			"<td><a target='_blank' href='mailto:"+mail+"'>"+mail+"</a></td>"+
			"<td>"+firstname+"</td>"+
			"<td>"+lastname+"</td>"+
			"<td><a target='_blank' href='viewTeam.php?id="+teamId+"'>"+teamId+"</a></td>"+
			"<td><a target='_blank' href='../user/uploads/"+imageURL+"'>"+imageURL+"</a></td>"+
			"<td>"+ban+"</td>"+
			"</tr>");
		
	}
}