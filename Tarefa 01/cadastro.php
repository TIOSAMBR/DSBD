<?php
session_start();
$preco_step = 0.01;
$preco_min = 0;
$preco_max = 5000;
$estoque_min = 0;
$estoque_max = 10000;
$required = "required"; 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
</head>
<body>
    <h2>Cadastro de Produto</h2>
    <form action="dados.php" method="post">
    Nome do Produto: <input type="text" name="nome" <?php echo $required; ?>><br>
        Descrição do Produto: <textarea name="descricao" <?php echo $required; ?>></textarea><br>
        Preço do Produto: <input type="number" name="preco" step="<?php echo $preco_step; ?>" min="<?php echo $preco_min; ?>" max="<?php echo $preco_max; ?>" <?php echo $required; ?>><br>
        Quantidade em Estoque: <input type="number" name="estoque" min="<?php echo $estoque_min; ?>" max="<?php echo $estoque_max; ?>" <?php echo $required; ?>><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
