function requestApi(city, callback) {
    let apiKey = 'c9483211cb911cbce5311029119e1de6';  // clé API
    let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=fr`; // url API

    let req = new XMLHttpRequest(); // création du requêteur
    
    req.open('GET', url, true); 
    req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status === 200) { // Si la requête fini et réussi
            let data = JSON.parse(req.responseText); // converti le json réponse en tableau
            callback(data); // retourne les données
        } else if (req.readyState === 4) { // Sinon 
            console.error('Error: ' + req.status); // affichage de l'erreur en console
            callback('error');
        }
    };

    req.send();
}

function getWeatherData(){
    const USER_INPUT = document.getElementById('city');
    const WEATHER_DIV = document.getElementById('weather');
    const WEATHER_IMG = document.getElementById('weather_img');
    
    if (USER_INPUT.value.length > 0){
        requestApi(USER_INPUT.value, function(data) {

            if(data == 'error'){
                WEATHER_DIV.innerHTML = `<p>La ville n'a pas été trouvée</p>`;
                WEATHER_IMG.src ="";
            }

            const DESC = data['weather'][0]['description'];

            // définit l'image en fonction de ma description
            if (DESC.includes('pluie')) {
                WEATHER_IMG.src = "image/pluvieux.png";
            } else if (DESC.includes('nuageux')) {
                WEATHER_IMG.src ="image/nuageux.png";
            } else if (DESC.includes('nuages')) {
                WEATHER_IMG.src ="image/nuageux.png";
            } else if (DESC.includes('couvert')) {
                WEATHER_IMG.src ="image/nuageux.png";
            } else if (DESC.includes('orage')) {
                WEATHER_IMG.src ="image/orage.png";
            } else if (DESC.includes('neige')) {
                WEATHER_IMG.src ="image/neige.png";
            } else {
                WEATHER_IMG.src ="image/soleil.png";
            }

            // ajout des données météo sur la page
            WEATHER_DIV.innerHTML = `<p>${data['name']}</p>`; 
            WEATHER_DIV.innerHTML += `<p>${Math.ceil(data['main']['temp'] * 10) / 10}°C</p>`; // Math.ceil permet d'arrondir un nombre donné
            WEATHER_DIV.innerHTML += `<p>${DESC}</p>`;
            USER_INPUT.value = "";
        });
    } else {
        console.log('No city'); // Si aucune ville n'est trouvé
    }

    return false; // évite que le formulaire soit envoyé et donc que la page se recharge
}
