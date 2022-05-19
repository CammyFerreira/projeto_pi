<?php
// require '../controleDeAcesso.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jogos</title>
</head>
<body>
    <h5>CRUD Jogos</h5>
    <div>
        <form action="gravaJogo.php" 
                method="post"
                enctype="multipart/form-data">
            <label for="jogo">Nome</label>
            <input type="text" id="jogo" name="jogo">
            <br><br>
            <label for="jogo">Descrição</label>
            <input type="text" id="descricao" name="descricao">
            <br><br>
            <input type="file" name="figura">
            <br><br>
            <input type="submit" value="Gravar">
        </form>
    </div>
    <div>
        <a href="listarJogo.php">Listar</a>
    </div>
</body>
</html>