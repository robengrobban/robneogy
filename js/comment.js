let jsonComment;

function loadComments(num) {
	//skapa ett anslutnings objekt
	var xhttp = new XMLHttpRequest();

	//välj fil att ansluta till
	xhttp.open("POST", "php/getCommentInfo.php", true);
	//post, typ
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Skicka förfrågan med bunden variabel
    xhttp.send("gameId="+num);

    //vänta på svar
    xhttp.onreadystatechange = function() {
        //Kontrollera att rätt typ av svar skickas
        if ( this.readyState == 4 && this.status == 200 ) {
            //Hämta response texten
            jsonComment = this.responseText;

            //Gör om svaret till JSON
            jsonComment = JSON.parse(jsonComment);

			//Visa kommentar
			displayComments();

        }
    };
}

function displayComments() {
	//Tömmer alla kommentarer
	var dom = $("#comment-container #the-comments");
	dom.empty();

	//Går igenom alla kommentarer
	for (var i = 0; i < jsonComment.length; i++) {
		var comment = jsonComment[i].content;
		var commenter = jsonComment[i].username;

		dom.append("<section class='comment'><p>"+comment+"</p><span><a href='kollaKonto.php?user="+commenter +"'>"+commenter+"</a></span></section>");

	}
}

let laddningsTidSekunder = 30;
function startCommentLoad(num) {
	laddning = setInterval(loadComments, (laddningsTidSekunder * 1000), num);
}
function stopCommentLoad() {
	clearInterval(laddning);
}
