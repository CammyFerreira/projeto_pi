<?php
include('../conexao.php');
$titulo = "Sistema de Busca";
include('../components/head.inc.php');
include('../components/default_header.inc.php');
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
        <button type="submit" class="btn btn-secondary btn-sm">Pesquisar</button>
    </form>
    <br>
    <table width="600px" class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Empresa</th>
            <th>Imagem</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
            ?>
        <tr>
            <td colspan="3">Digite algo para pesquisar...</td>
        </tr>
        <?php
        } else {
            $pesquisa = $_GET['busca'];
            $sql_code = "SELECT * 
            FROM jogo 
            WHERE apagado = 0 AND (nome LIKE '%$pesquisa%' 
            OR empresa LIKE '%$pesquisa%'
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
                    $img = 'N/D';    

                    if(!empty($dados['imagem'])){
                        if(is_file($dados['imagem'])){
                                $img = "<img src='{$dados['imagem']}' width='50' height='50' class='rounded-circle'>";
                        }
                    }    
                    ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['empresa']; ?></td>
                        <td><?php echo $img; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        <?php
        } ?>
    </table>
    <a href="listarJogo.php" class="btn btn-secondary btn-sm">Voltar</a>
</body>
</html>
