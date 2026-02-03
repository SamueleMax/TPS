<?php
$wsdl = "http://localhost/conversione.wsdl";

$client = new SoapClient($wsdl, ["location" => "http://localhost/server.php"]);

$resIn = NULL;
$resCm = NULL;

if (isset($_POST["pollici"])) {
    try {
        $resCm = $client->inToCm($_POST["pollici"]);
    } catch (SoapFault $e) {
        $resCm = $e;
    }
}

if (isset($_POST["centimetri"])) {
    try {
        $resIn = $client->cmToIn($_POST["centimetri"]);
    } catch (SoapFault $e) {
        $resIn = $e;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WSDL</title>
        <style>
            body {
                font-family: system-ui, sans-serif;
            }
            main {
                display: flex;
                flex-direction: column;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                text-align: center;
            }
            h2:not(:first-of-type) {
                margin-top: 5rem;
            }
        </style>
    </head>
    <body>
        <main>
            <h2>Pollici a Centimetri</h2>
            <form method="post" action="">
                <input type="text" name="pollici" placeholder="Pollici">
                <button type="submit">Converti</button>
            </form>
            <p>
                <?php if ($resCm !== NULL) echo $resCm; ?>
            </p>
            <h2>Centimetri a Pollici</h2>
            <form method="post" action="">
                <input type="text" name="centimetri" placeholder="Centimetri">
                <button type="submit">Converti</button>
            </form>
            <p>
                <?php if ($resIn !== NULL) echo $resIn; ?>
            </p>
        </main>
    </body>
</html>