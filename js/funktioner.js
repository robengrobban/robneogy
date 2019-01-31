function getName(jsonData, teamNum) {
    for (var i = 0; i < jsonData.length; i++) {
        if (jsonData[i].id == teamNum) {
            return jsonData[i].name;
        }
    }
}