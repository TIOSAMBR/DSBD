<?php
$hostname = "localhost";
$bancodedados = "upload";
$usuario = "root";
$senha = "";


$mysqli = new mysqli($hostname,$usuario,$senha,$bancodedados);

if($mysqli->connect_error){
    echo "Erro ao conectar ao banco de dados".$mysqli->connect_error;
    exit();
}else {
    # code...
    echo "Banco de dados conectado com sucesso.";
}


?>