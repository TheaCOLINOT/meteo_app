<?php
// Configuration de l'API OpenWeather
$apiKey = "c9483211cb911cbce5311029119e1de6"; //Clé OpenWeather

if(!empty($_GET["city"])) { // vérifie si le paramètre city exite et est remplit
    $city = htmlspecialchars($_GET["city"]);
} else { // sinon on lui donne une valeur par défaut => Paris
    $city = "Paris";
}

$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=fr";

$curl = curl_init(); // initialisation du requêteur
// setopt => set option
curl_setopt($curl, CURLOPT_URL, $apiUrl); // ajout de l'url de l'api
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // renvoie le contenue de la page cible
$response = curl_exec($curl); // éxécution de la requête
curl_close($curl); // fermeture du requêteur

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

$result = [
    "name" => $cityName,
    "temp" => $temperature,
    "desc" => $description
];

header('Content-Type: application/json');
echo json_encode($result); // encodage du tableau au format json

?>