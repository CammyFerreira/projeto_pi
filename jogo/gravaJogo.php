<?php
// require '../controleDeAcesso.php';
require '../conexao.php';

$jogo = $_POST['jogo'];
$descricao = $_POST['descricao'];

$arquivoEnviado = '';

if($_FILES['figura']['error'] == 0 &&
    $_FILES['figura']['size'] > 0){

    $mimeType = mime_content_type($_FILES['figura']['tmp_name']);

        echo "entrou caca";

    $campos = explode('/', $mimeType);
    $tipo = $campos[0];
    $ext = $campos[1];


    
    var_dump($tipo);

    if($tipo == 'image'){

        $arquivoEnviado = '../img/' . $_FILES['figura']['name'] 
                . '_' . md5(rand(-9999999, 9999999) . microtime()) 
                    . '.' . $ext;
        
                    var_dump($arquivoEnviado);

        move_uploaded_file($_FILES['figura']['tmp_name'], "$arquivoEnviado");
    }else{
        echo "Arquivo ignorado por não se tratar de um arquivo de imagem<br>";
    }
}

$stmt = $bd->prepare('INSERT INTO jogo (nome, descricao, imagem) VALUES (:nome, :descricao, :imagem)');

$stmt->bindParam(':nome', $jogo);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':imagem', $arquivoEnviado);

if($stmt->execute() ){

    echo "$jogo gravada com sucesso!";
}else{
    echo "Problema ao gravar $jogo";
}

echo "<br><a href='index.php'>Voltar</a>";