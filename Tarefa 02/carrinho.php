<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['sair'])){
    session_unset();
    session_destroy();

    setcookie("carrinho", "", time() - 3600, "/");

    header("Location: login.php");
    exit();
}

if(isset($_COOKIE['carrinho'])){
    $carrinho = json_decode($_COOKIE['carrinho'], true);
} else {
    $carrinho = [];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['produto']) || !is_numeric($_POST['quantidade']) || $_POST['quantidade'] <= 0){
        $erro = "Preencha corretamente.";
    } else {
        $produto = $_POST['produto'];
        $quantidade = intval($_POST['quantidade']);

        if(isset($carrinho[$produto])){
            $carrinho[$produto] += $quantidade;
        } else {
            $carrinho[$produto] = $quantidade;
        }

        setcookie("carrinho", json_encode($carrinho), time() + (72 * 3600), "/");

        header("Refresh: 0");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h2>Carrinho de Compras</h2>
    <p>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>

    <?php if(isset($erro)) echo "<p>$erro</p>"; ?>

    <table border="1">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
        </tr>
        <?php foreach($carrinho as $produto => $quantidade): ?>
        <tr>
            <td><?php echo $produto; ?></td>
            <td><?php echo $quantidade; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="produto">Produto:</label><br>
        <input type="text" id="produto" name="produto"><br>
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" min="1"><br><br>
        <input type="submit" value="Adicionar">
    </form>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" name="sair" value="Sair">
    </form>
</body>
</html>
