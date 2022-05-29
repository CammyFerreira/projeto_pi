<?php

//ligar o php ao banco de dados

$dsn = 'mysql:dbname=php;host=localhost';
$user = "root";
$pass = "";

$bd = new PDO($dsn, $user, $pass);
// FIM da conexão