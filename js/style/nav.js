//BEHÖVER JQUERY LÄNKAT
//Gär så att naven går att öppna / stänga
$(document).ready(function(){
	//Bind en klick funktion till meny knappen
	$("#menu").click(function(){
		//Toggla mellan klassen, menushow
		$("#main-nav ul").toggleClass("menushow");
	});
});
