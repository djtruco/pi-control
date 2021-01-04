<?php

require 'GPIO.php';

$GPIO = new GPIO();

header('Content-type: application/json');

$parameter = $_POST['parameter'];
$value = intval($_POST['value']);

$port = intval(str_replace('GPIO_', '', $parameter));

if ($GPIO->getValue($port) == '') {
    $GPIO->export($port);
    $GPIO->setDirection($port, 'out');
}

$GPIO->setValue($port, $value);

$output['result'] = 1;

echo json_encode($output);
