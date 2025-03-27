<?php

$servername = "127.0.0.1";
$port = 4306;
$username = "root";
$password = "";
$dbname = "menara_teratai";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

$conn->set_charset("utf8");
