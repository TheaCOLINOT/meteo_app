<?php



$apiUrl = "http://localhost/meteo_app/api_meteo.php";


$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $apiUrl);
$response = curl_exec($curl);
curl_close($curl);

echo $response;
$weatherData = json_decode($response, true);

echo $weatherData['name'];

?>


<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-center">
                <form method="get" action="">
                    <p>
                        <label for="prenom">Ville :</label>
                        <input type="text" name="ville" id="ville" required placeholder="Ex. : Paris" size="30" maxlength="20">
                        <input type="submit" value="Envoyer">
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
