<?php
// require '../controleDeAcesso.php';
require_once '../conexao.php';

$id = preg_replace('/\D/', '', $_POST['id']);

//Atualiza o registro
if(isset($_POST['jogo'])){

    $arquivoEnviado = '';

    if($_FILES['figura']['error'] == 0 &&
        $_FILES['figura']['size'] > 0){
    
        $mimeType = mime_content_type($_FILES['figura']['tmp_name']);
    
        $campos = explode('/', $mimeType);
        $tipo = $campos[0];
        $ext = $campos[1];
    
        if($tipo == 'image'){
    
            $arquivoEnviado = 'imagens/' . $_FILES['figura']['name'] 
                    . '_' . md5(rand(-9999999, 9999999) . microtime()) 
                        . '.' . $ext;
    
            move_uploaded_file($_FILES['figura']['tmp_name'], "$arquivoEnviado");
        }else{
            echo "Arquivo ignorado por não se tratar de um arquivo de imagem<br>";
        }
    }

    $stmt = $bd->prepare('  UPDATE jogo 
                            SET nome = :nome, descricao = :descricao, imagem = :imagem 
                            WHERE id = :id');
    $stmt->bindParam(':nome', $_POST['jogo']);
    $stmt->bindParam(':descricao', $_POST['jogo']);
    $stmt->bindParam(':imagem', $arquivoEnviado);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Jogo atualizado";
    }else{
        echo "Erro ao atualizar o jogo";
    }
}//FIM Atualiza o registro

$stmt = $bd->query("SELECT nome, descricao, imagem FROM jogo WHERE id = $id");
$stmt->execute();
$jogo = $stmt->fetch(PDO::FETCH_ASSOC);

$img = 'N/D';

if(!empty($jogo['imagem'])){
    if(is_file($jogo['imagem'])){
        $img = "<img src='{$jogo['imagem']}' width='50' heigth='50'>";
    }
}

echo "  <form method='post' enctype='multipart/form-data'>
            <label for='jogo'>Nome</label>
            <input type='text' id='jogo' name='nome' 
                value='{$jogo['nome']}'><br><br>
            <label for='jogo'>Descrição</label>
            <input type='text' id='jogo' name='descricao' 
                value='{$jogo['descricao']}'><br><br>
            $img<br>
            <input type='file' name='figura'>
            <br><br>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='Atualizar'>
        </form><br><br><a href='listarJogo.php'>Voltar</a>";   