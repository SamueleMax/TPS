<?php
function inToCm($inches) {
    return $inches * 2.54;
}

function cmToIn($cm) {
    return $cm / 2.54;
}

$server = new SoapServer("conversione.wsdl");
$server->addFunction("inToCm");
$server->addFunction("cmToIn");
$server->handle();