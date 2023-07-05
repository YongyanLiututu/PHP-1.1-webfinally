<?php

$json_data = file_get_contents("./cars.json");
$cars_array = json_decode($json_data, true);
define('APP', 'ass1');
require './index.php';

?>