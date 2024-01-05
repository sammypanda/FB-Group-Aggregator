<?php

// File for init common dependencies

require '../vendor/autoload.php'; // for auto-loading classes/namespaces
$dotenv = Dotenv\Dotenv::createImmutable('../'); // create dotenv instance at root dir
$dotenv->load(); // load dotenv variables in .dotenv at root dir

?>