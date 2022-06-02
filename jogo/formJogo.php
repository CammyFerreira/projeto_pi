<?php
// require '../controleDeAcesso.php';
$titulo = "CRUD Jogos";
include('../components/head.inc.php');
include('../components/default_header.inc.php');

echo "<h5 class='mt-5'>CRUD Jogos</h5>
<div>
    <form action='gravaJogo.php' 
            method='post'
            enctype='multipart/form-data' class='mt-3'>
        <label for='jogo'>Nome</label>
        <input  required type='text' id='jogo' name='jogo'>
        <br><br>
        <label for='jogo'>Descrição</label>
        <input  required type='text' id='descricao' name='descricao'>
        <br><br>
        <input type='file' name='figura'>
        <br><br>
        <input type='submit' value='Gravar'>
    </form>
</div>
<div class='mt-5'>
    <a href='listarJogo.php'>Listar</a>
</div>";