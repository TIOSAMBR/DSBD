<?php
session_start();

if(isset($_SESSION['usuario'])){
    header("Location: carrinho.php");
    exit();
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['usuario'] === 'samuel' && $_POST['senha'] === '123'){
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: carrinho.php");
            exit();
        } else {
            $erro = "Usuário ou senha incorretos.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(!empty($erro)) echo "<p>$erro</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="usuario">Usuário:</label><br>
        <input type="text" id="usuario" name="usuario"><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
