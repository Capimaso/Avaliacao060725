<?php

require("conexao.php");
echo '0';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    echo '1';
    $query = "DELETE FROM eventos WHERE nome = '$nome'";
    echo '2';
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    echo '3';
    header('Location: index.php');
    die();
}