<?php

include('../conexao.php');
require 'editarJogo.php';
//require 'apagaJogo.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca</title>
</head>
<body>
    <h1>Lista de Jogos</h1>
    <form action="">
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <form method="post">
        <table width="600px" border="1">
            <?php
                $_GET['busca'] =  $_GET['busca'] ?? '';
            ?>
            <?php
        
                $pesquisa = $_GET['busca'];
                $sql_code = "SELECT * 
                    FROM jogo 
                    WHERE apagado = 0 AND (nome LIKE '%$pesquisa%' 
                    OR descricao LIKE '%$pesquisa%'
                    OR imagem LIKE '%$pesquisa%')";
                $sql_query = $bd->query($sql_code) or die("ERRO ao consultar! " . $bd->error); 
                
                if ($sql_query->rowCount() == 0) {
                    ?>
                <tr>
                    <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
                } else {
                    while($dados = $sql_query->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['descricao']; ?></td>
                            <td><img src="<?php echo $dados['imagem'];?>" heigth="100" width="167"></td>
                            <td><button name='id' formaction='editarJogo.php' 
                            value="<?php echo $dados['ID'] ?>">Editar</button></td>
                            <td><button name='id' formaction='apagaJogo.php' 
                            value="<?php echo $dados['ID']; ?>">Apagar</button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            <?php
            ?>
        </table>
    </form>
</body>
</html>