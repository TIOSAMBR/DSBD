<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["produto"] = $_POST;
    header("Location: dados.php");
    exit;
}

if (!empty($_SESSION["produto"])) {
    $produto = $_SESSION["produto"];
    echo "<h2>Dados do Produto</h2>";
    echo "<p>Nome: " . $produto["nome"] . "</p>";
    echo "<p>Descrição: " . $produto["descricao"] . "</p>";
    echo "<p>Preço: R$ " . $produto["preco"] . "</p>";
    echo "<p>Estoque: " . $produto["estoque"] . "</p>";
    
}
?>
