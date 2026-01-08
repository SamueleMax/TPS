<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Cifratura e Decifratura RSA</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            display: flex;
            justify-content: center;
            padding: 50px;
        }
        form {
            padding: 20px;
            border-radius: 5px;
        }
        input[type=text] {
            padding: 5px;
            width: 200px;
        }
        input[type=submit] {
            padding: 5px 10px;
        }
        .result {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
$pub = json_decode(file_get_contents('pub.json'), true);
$priv = json_decode(file_get_contents('priv.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $msg = $_POST['message'];
    $cipher = [];
    $plain = '';

    // Cifratura
    for ($i = 0; $i < strlen($msg); $i++) {
        $m = ord($msg[$i]);
        $c = pow($m, $pub['e']) % $pub['n'];
        $cipher[] = $c;
    }

    // Decifratura
    for ($i = 0; $i < count($cipher); $i++) {
        $m = pow($cipher[$i], $priv['d']) % $priv['n'];
        $plain .= chr($m);
    }

    echo '<div class="result">';
    echo "<strong>Messaggio originale:</strong> " . $msg . "<br>";
    echo "<strong>Cifrato:</strong> " . implode(', ', $cipher) . "<br>";
    echo "<strong>Decifrato:</strong> " . $plain;
    echo '</div>';
}
?>

<form method="post">
    Messaggio: <input type="text" name="message">
    <input type="submit" value="Invia">
</form>

</body>
</html>
