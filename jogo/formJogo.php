<?php
$titulo = "CRUD Jogos";
include('../components/head.inc.php');

echo "
<link href='formJogo.css' rel='stylesheet'>
<div class='registration-form'>
    <form action='gravaJogo.php' 
            method='post'
            enctype='multipart/form-data' class='mt-3'>
            
            <div>
            <img src='../img/logoCrud.png' alt='Logo' style='width:120px;' class='default-header-logo rounded-pill'>

        </div>

        <h5 class='mt-5'>Cadastre seu Jogo</h5>
        
        <div class='form-group'>
        <input  required type='text'  class='form-control item' id='jogo' placeholder='Nome do jogo' name='jogo'>
    </div>
    <div class='form-group'>
        <input  required type='text' id='descricao' name='descricao' class='form-control item' placeholder='Empresa'>
    </div>
    <div class='form-group'>
        <input type='file' name='figura'>
        </div>
    <div class='form-group'>
        <input type='submit' value='Gravar' class='btn btn-block create-account'>
        </div>

        <div class='mt-5'>
    <a href='listarJogo.php'class='btn btn-dark btn-lg active' role='button' aria-pressed='true' >Listar</a>
        </div>
    </form>
</div>";
