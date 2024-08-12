function requestApi(city, callback) {
    let apiKey = 'c9483211cb911cbce5311029119e1de6'; 
    let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=fr`;

    let req = new XMLHttpRequest();
    req.open('GET', url, true);

    req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status === 200) {
            let data = JSON.parse(req.responseText);
            console.log(data);
            callback(data);
        } else if (req.readyState === 4) {
            console.error('Error: ' + req.status);
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

            const DESC = data['weather'][0]['description'];
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

            WEATHER_DIV.innerHTML = `<p>${data['name']}</p>`;
            WEATHER_DIV.innerHTML += `<p>${data['main']['temp']}°C</p>`;
            WEATHER_DIV.innerHTML += `<p>${DESC}</p>`;
            USER_INPUT.value = "";
        });
    } else {
        console.log('No city');
    }

    return false;
}
