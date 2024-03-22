<?php
    // UTILIZANDO BANCO DE DADOS
    include("conexao.php");

    // method deve ser o post
    if(isset($_FILES['arquivo'])){
        $arquivo = $_FILES['arquivo'];
        var_dump($_FILES['arquivo']);

        if($arquivo['error'])//Servidor sem espaço..Upload falhar
            die("Falha ao enviar arquivo.");
        
        //Tamanho máximo 2mb
        if($arquivo['size'] > 2097152)
            die("Arquivo muito grande! Tamanho máximo: 2MB");
        //Define onde salvar no servidor
        $pasta = "arquivos/";

        //Armazenar nome original do arquivo
        $nomeDoArquivo = $arquivo['name'];

        //Gerar nome único
        $nomeUnicoDoArquivo = uniqid();

        //Pegar extensão do arquivo
        //echo "<br>Extensão::".pathinfo("god-of-war-ragnarok-3-2.jpg", PATHINFO_EXTENSION);
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION)); 

        if($extensao != "jpg" && $extensao != "png")
            die("Tipo de arquivo não aceito.");;

        $destino = $pasta . $nomeUnicoDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $destino);
        if($deu_certo){
            //data_upload pode ser NOW() também
            $mysqli->query("INSERT INTO arquivos(nome, path) VALUES('$nomeDoArquivo','$destino')")
                or die($mysqli->error);
            echo "Arquivo enviado com sucesso!";
            //echo "<p>Arquivo enviado com sucesso!<br>Para acessá-lo, clique aqui: 
            //<a target='_blank' href='arquivos/$nomeUnicoDoArquivo.$extensao'>Clique aqui</a></p>";
        } else {
            echo "Falha ao enviar arquivo!";
        }
    }

    // Excluir arquivo se o ID for passado via GET
    if(isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = $mysqli->query("SELECT * FROM arquivos WHERE id = $delete_id");
        if($delete_query->num_rows == 1) {
            $file_to_delete = $delete_query->fetch_assoc();
            $file_path = $file_to_delete['path'];
            // Remove do banco de dados
            $mysqli->query("DELETE FROM arquivos WHERE id = $delete_id");
            // Remove o arquivo do servidor
            unlink($file_path);
            echo "Arquivo excluído com sucesso.";
        } else {
            echo "Arquivo não encontrado.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post">
        <p><label for="">Selecione o arquivo</label>
        <input type="file" name="arquivo"></p>
        <button type="submit">Enviar arquivo</button>
    </form>

    <h1>Lista de Arquivos</h1>
    <table border="1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de Envio</th>
            <th>Ações</th> <!-- Nova coluna para ações -->
        </thead>
        <tbody>
        <?php
            //Consultar arquivos enviados
            $sql_query = $mysqli->query("SELECT * FROM arquivos") or die($mysqli->error);
            while($arquivo = $sql_query->fetch_assoc()){
        ?>
            <tr>
                <td><img height="50" src="<?php echo $arquivo['path']; ?>" alt=""></td>
                <td><a target="_blank" href="<?php echo $arquivo['path']; ?>"><?php echo $arquivo['nome']; ?></a></td>
                <td><?php echo date("d/m/Y H:i",strtotime($arquivo['data_upload'])); ?></td>
                <td>
                    <a href="?delete_id=<?php echo $arquivo['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')">Excluir</a>
                </td> <!-- Link para excluir arquivo -->
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    
</body>
</html>
