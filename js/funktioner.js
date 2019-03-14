//Hämta ett namn från en uppsättning JSON data
function getName(jsonData, teamNum) {
    for (var i = 0; i < jsonData.length; i++) {
        if (jsonData[i].id == teamNum) {
            return jsonData[i].name;
        }
    }
}
//Öppna en maptch med 
function openMatch(num) {
    //Skicka användaren till match sida sida
    window.location = "match.php?id=" + num;
}
