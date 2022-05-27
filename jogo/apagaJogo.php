<?php
require_once '../conexao.php';

//Evita SQL Injection
$id = preg_replace('/\D/', '', $_POST['id']);//Elimina tudo que não é número

var_dump($id);

if($bd->exec("UPDATE jogo SET apagado = 1 WHERE id = $id")){

    echo "Jogo apagado com sucesso! ";

}else{

    echo "Erro ao tentar apagar o jogo!";
}

echo "<br><br><a href='listarJogo.php'>Voltar</a>";