<?php
// require '../controleDeAcesso.php';
$titulo = "CRUD Jogos";
include('../components/head.inc.php');

echo "<h5>CRUD Jogos</h5>
<div>
    <form action='gravaJogo.php' 
            method='post'
            enctype='multipart/form-data'>
        <label for='jogo'>Nome</label>
        <input type='text' id='jogo' name='jogo'>
        <br><br>
        <label for='jogo'>Descrição</label>
        <input type='text' id='descricao' name='descricao'>
        <br><br>
        <input type='file' name='figura'>
        <br><br>
        <input type='submit' value='Gravar'>
    </form>
</div>
<div>
    <a href='listarJogo.php'>Listar</a>
</div>";