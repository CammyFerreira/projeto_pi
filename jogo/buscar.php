<?php
include('../conexao.php');
$titulo = "Sistema de Busca";
include('../components/head.inc.php');
?>

<h1>Lista de Jogos</h1>
<form action="">
    <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
    <button type="submit">Pesquisar</button>
</form>
<br>
<table width="600px" border="1">
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
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
            WHERE nome LIKE '%$pesquisa%' 
            OR descricao LIKE '%$pesquisa%'
            OR imagem LIKE '%$pesquisa%'";
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
                    <td><?php echo $dados['imagem']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    <?php
    } ?>
</table>
<a href='listarJogo.php'>Voltar</a>