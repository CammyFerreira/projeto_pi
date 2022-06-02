<?php
// require '../controleDeAcesso.php';
require '../conexao.php';
$titulo = "Meu titulo";
include('../components/head.inc.php');
include('../components/default_header.inc.php');
include('../components/container.inc.php');

$stmt = $bd->query('SELECT id, nome, descricao, imagem FROM jogo WHERE apagado = 0');

$stmt->execute();

echo "
        <link rel='stylesheet' href='listarJogo.css'>
        <div class='menu'>
                <p>Jogos</p>

                <div class='botoes'>
                        <a href='formJogo.php' class='btn btn-secondary'>Novo Jogo</a>
                        <a href='buscar.php' class='btn btn-secondary'>Buscar</a>
                </div>
        </div>

        <form method='post'>
        <!-- table-hover -->
        <table class='table table-striped'>
        <thead class='table-dark'>
                <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Imagem</th>
                        <th>Editar/Apagar</th>
                </tr>
        </thead>
        <tbody>";

while($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $img = 'N/D';    

    if(!empty($reg['imagem'])){
        if(is_file($reg['imagem'])){
                $img = "<img src='{$reg['imagem']}' width='50' height='50' class='rounded-circle'>";
        }
    }    

    echo "
        <tr>
                <th>{$reg['id']}</th>
                <td>{$reg['nome']}</td>
                <td>{$reg['descricao']}</td>
                <td>$img</td>
                <td>
                        <button name='id' formaction='editarJogo.php' 
                                value='{$reg['id']}' class='btn btn-secondary'>Editar</button>
                        <button name='id' formaction='apagaJogo.php' 
                        value='{$reg['id']}' class='btn btn-secondary'>Apagar</button>
                </td>
        </tr>
    ";
}
echo "</tbody>";

echo "<table></form><br><button name='id' formaction='logout.php' class='btn btn-secondary'>Sair</button>";