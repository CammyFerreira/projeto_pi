<?php
// require '../controleDeAcesso.php';
require_once '../conexao.php';
$titulo = "Editar jogo";
include('../components/head.inc.php');
include('../components/container.inc.php');

$jogo = '';
$id = preg_replace('/\D/', '', $_POST['id']);

ConsultarDados();

// Definição de chamada das ações
if (array_key_exists('btnAtualizar', $_POST)){
    AtualizarRegistro();
    ConsultarDados();
}

// Consulta dados do jogo.
function ConsultarDados() {
    $id = $GLOBALS["id"];
    $bd = $GLOBALS["bd"];

    $stmt = $bd->query("SELECT nome, descricao, imagem FROM jogo WHERE id = $id");
    $stmt->execute();
    $GLOBALS["jogo"] = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Atualiza dados do jogo.
function AtualizarRegistro() {

    $bd = $GLOBALS["bd"];
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Verificar campos obrigatorios.
    if ($nome === "" || $descricao === ""){
        echo "Campos obrigatórios não foram preenchidos.";
        exit();
    }
    
    $arquivoEnviado = '';
   echo $arquivoEnviado;
    
    if($_FILES['figura']['error'] == 0 &&
        $_FILES['figura']['size'] > 0){
        
        echo "Entrou";
    
        $mimeType = mime_content_type($_FILES['figura']['tmp_name']);
    
        $campos = explode('/', $mimeType);
        $tipo = $campos[0];
        $ext = $campos[1];

        echo $tipo;

        if($tipo == 'image'){
    
            $arquivoEnviado = '../img/' . $_FILES['figura']['name'] 
                    . '_' . md5(rand(-9999999, 9999999) . microtime()) 
                        . '.' . $ext;
    
            move_uploaded_file($_FILES['figura']['tmp_name'], "$arquivoEnviado");
        }else{
            echo "Arquivo ignorado por não se tratar de um arquivo de imagem<br>";
        }
    }
    
    try {
        // Montando instrução SQL
        $sql = "UPDATE jogo
        SET
            nome = '$nome',
            descricao = '$descricao',
            imagem = '$arquivoEnviado'
        WHERE id = $id";

        // Execução da query
        $bd->exec($sql);
        echo "Jogo atualizado";
    } catch(PDOException $e) {
        echo "Erro ao atualizar o jogo";
        // die("ERROR: Could not able to execute $sql. "
        //                         . $e->getMessage());
    }
}

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
            <input type='submit' value='Atualizar' name='btnAtualizar'>
        </form><br><br><a href='listarJogo.php'>Voltar</a>";   