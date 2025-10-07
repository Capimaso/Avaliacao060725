<?php

$usuario = "root";
$senha  = "";
$dbname = "cadastro_eventos";
$host   = "localhost";


$pdo = new PDO
("mysql:host=$host;
dbname=$dbname", $usuario, $senha);
