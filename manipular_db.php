<?php

require("conexao.php");
echo '0';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome        = $_POST["nome"];
    $local       = $_POST["local"];
    $organizador = $_POST["organizador"];
    $data        = $_POST["data"];
    
    $query = "INSERT INTO eventos(nome, local, organizador, data) VALUES ('$nome', '$local', '$organizador', '$data')";
    
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    
    header('Location: index.php');
    die();
}