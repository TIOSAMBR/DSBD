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
        Nome do Produto: <input type="text" name="nome" required><br>
        Descrição do Produto: <textarea name="descricao" required></textarea><br>
        Preço do Produto: <input type="number" name="preco" step="0.01" min="0" max="5000" required><br>
        Quantidade em Estoque: <input type="number" name="estoque" min="0" max="10000" required><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
