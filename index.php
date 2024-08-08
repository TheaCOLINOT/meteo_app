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

?>


<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <header class="d-flex justify-content-center">
            <h1>Météo</h1>
        </header>
        <main>
            <div class="w-100 mt-5 justify-content-center">
                <div class="d-flex justify-content-center">
                    <form method="get" action="" class="p-4 bg-light border rounded">
                        <label for="city" class="form-label" >Ville :</label>
                        <input type="text" name="city" id="city" required placeholder="Ex. : Paris" size="30" maxlength="20" class="form-control">
                        <input type="submit" value="Envoyer" class="btn btn-primary w-100">
                    </form>
                </div>
                <div>
                    <p><?= isset($weatherData["name"]) ? $weatherData["name"] : "City not found" ?></p>
                    <p><?= isset($weatherData["temp"]) ? $weatherData["temp"] : "" ?></p>
                    <p><?= isset($weatherData["desc"]) ? $weatherData["desc"] : "" ?></p>
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
