<?php
// Configuration de l'API OpenWeather
$apiKey = "c9483211cb911cbce5311029119e1de6"; //Clé OpenWeather
$city = "Paris"; // Ville souhaitée
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=fr";

// Effectuer la requête vers l'API OpenWeather
$response = file_get_contents($apiUrl);

// Vérifier si la requête a réussi
if ($response === FALSE) {
    die('Erreur lors de la récupération des données météorologiques.');
}

// Décoder la réponse JSON
$weatherData = json_decode($response, true);

// Vérifier si les données sont valides
if ($weatherData['cod'] !== 200) {
    die("Erreur: " . $weatherData['message']);
}

// Extraire les informations météorologiques
$temperature = $weatherData['main']['temp'];
$description = $weatherData['weather'][0]['description'];
$cityName = $weatherData['name'];

// Afficher les informations météorologiques
echo "La météo à {$cityName} : <br>";
echo "Température : {$temperature}°C <br>";
echo "Description : {$description} <br>";

?>
