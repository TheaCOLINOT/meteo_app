function requestApi(city) {
    let apiKey = 'c9483211cb911cbce5311029119e1de6'; 
    let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=fr`;

    let req = new XMLHttpRequest();
    req.open('GET', url, true);

    req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status === 200) {
           let data = JSON.parse(req.responseText);
        } else if (req.readyState === 4) {
            console.error('Error: ' + req.status);
        }
    };

    return req.send();
}

function getWeatherData(){
    const USER_INPUT = document.getElementById('cityInput');
    const WEATHER_DIV = document.getElementById('weather');
    if (USER_INPUT.value.length > 0){
        // const RESULT = requestApi(USER_INPUT.value);
        // console.log(RESULT);
        // USER_INPUT.value = "";
        
        // WEATHER_DIV.innerHTML = `${RESULT['main']['temp']}°C`;

    } else {
        console.log('No city');
    }

    return false;
}

