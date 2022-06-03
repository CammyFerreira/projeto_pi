<?php
// require '../controleDeAcesso.php';
$titulo = "CRUD Jogos";
include('../components/head.inc.php');
include('../components/default_header.inc.php');

echo "
<link href='formJogo.css' rel='stylesheet'>
<div class='registration-form'>
    <form action='gravaJogo.php' 
            method='post'
            enctype='multipart/form-data' class='mt-3'>
            
            <div class='form-icon'>
            <span><i class='icon icon-user'></i></span>

        </div>

        <h5 class='mt-5'>Cadastre seu Jogo</h5>
        
        <div class='form-group'>
        <input  required type='text'  class='form-control item' id='jogo' placeholder='Nome do jogo'>
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
