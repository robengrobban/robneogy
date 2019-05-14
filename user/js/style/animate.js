//Funktion för att animera fram start texten
//Behöver JQuery för att fungera
function animateFrontHeaderText() {
	//Spara front header
	var dom = $('#front-page-header h1');
	//Ge front header css värden för att animera in
	//Gör synlig och sätt i mitten
	dom.css(
		{
			"opacity": "1",
			"top": "50%"
		}
	);
}
