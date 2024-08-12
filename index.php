<?php


if(!empty($_GET["city"])) { // vérifie si le paramètre city existe et est remplit
    $apiUrl = "http://localhost/meteo_app/api_meteo.php?city={$_GET['city']}"; // on appelle l'api avec le paramètre city
} else { // sinon on appel simplement la page api sans paramètre
    $apiUrl = "http://localhost/meteo_app/api_meteo.php";
}

$curl = curl_init(); // initialisation du requêteur
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ajout de l'url de l'api
curl_setopt($curl, CURLOPT_URL, $apiUrl); // renvoie le contenue de la page cible
$response = curl_exec($curl); // éxécution de la requête
curl_close($curl); // fermeture du requêteur

$weatherData = json_decode($response, true); // decodage du format json au format tableau


if (isset($weatherData["desc"])) {

    if (str_contains($weatherData["desc"], 'ciel dégagé')) {
        $logo = "image\soleil.png";

    } else if (str_contains($weatherData["desc"], 'pluie')) {
        $logo = "image\pluvieux.png";
    } else if (str_contains($weatherData["desc"], 'nuageux')) {
        $logo = "image\\nuageux.png";
    } else if (str_contains($weatherData["desc"], 'nuages')) {
        $logo = "image\\nuageux.png";
    } else if (str_contains($weatherData["desc"], 'couvert')) {
        $logo = "image\\nuageux.png";
    } else if (str_contains($weatherData["desc"], 'orage')) {
        $logo = "image\orage.png";
    } else if (str_contains($weatherData["desc"], 'neige')) {
        $logo = "image\\neige.png";
    }
    //renvoi image correspondant à la météo actuelle de la ville séléctionnée, si pluie, affiche une illustration de la pluie
}
else {
    $logo="";
}

?>


<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    </head>
    <body>
        <header class="d-flex justify-content-center p-3">
            <h1 class="justify-content-center align-items-center">Météo</h1>
        </header>
        <main>
            <div class="w-100 mt-5 justify-content-center">
                <div class="d-flex justify-content-center">
                    <form method="get" action="" class="p-4 bg-light border rounded">
                        <label for="city" class="form-label" >Ville :</label>
                        <div class="mb-3">
                        <input type="text" name="city" id="city" required placeholder="Ex. : Paris" size="30" maxlength="100" class="form-control mb-3" >
                            <div class="mb-3">
                            <input type="submit" value="Envoyer" class="btn btn-primary w-100 mb-3">

                    </form>

                <div class="d-flex justify-content-around w-100">
                <div>
                    <p><?= isset($weatherData["name"]) ? $weatherData["name"] : "City not found" ?></p>
                    <p><?= isset($weatherData["temp"]) ? round($weatherData["temp"],1) : "" ?> °C</p>
                    <p><?= isset($weatherData["desc"]) ? ucfirst($weatherData["desc"]) : "" ?></p>
                </div>
                    <!--affichage température, descritpion, nom de la ville-->

                        <img class="img1" src="<?= $logo ?>">

                </div>
            </div>
        </main>
        <footer class="d-flex justify-content-center align-items-center">
            <a class="link-opacity-50-hover" href="https://openweathermap.org/"> Open Weather </a>
        </footer> <!--lien vers OpenWeather-->
    </body>
</html>
