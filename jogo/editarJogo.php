<?php
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

    $stmt = $bd->query("SELECT nome, empresa, imagem FROM jogo WHERE id = $id");
    $stmt->execute();
    $GLOBALS["jogo"] = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Atualiza dados do jogo.
function AtualizarRegistro() {

    $bd = $GLOBALS["bd"];
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];

    // Verificar campos obrigatorios.
    if ($nome === "" || $empresa === ""){
        echo "Campos obrigatórios não foram preenchidos. <br><br><a href='listarJogo.php'>Voltar</a>";
        exit();
    }
    
    $arquivoEnviado = '';
   echo $arquivoEnviado;
    
    if($_FILES['figura']['error'] == 0 &&
        $_FILES['figura']['size'] > 0){
    
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
            empresa = '$empresa',
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

echo "  
<link href='formJogo.css' rel='stylesheet'>  
<div class='registration-form'>
<form method='post' enctype='multipart/form-data' class= 'mt-5'>
<div>
<img src='../img/logoCrud.png' alt='Logo' style='width:120px;' class='default-header-logo rounded-pill'>

        </div>
        <h5 class='mt-5'>Editar Jogo</h5>
        <div class='form-group'>
            <input type='text' id='jogo' name='nome' 
                value='{$jogo['nome']}' class='form-control item' placeholder='Nome do jogo'>
        </div>
        <div class='form-group'>
            <input type='text' id='jogo' name='empresa' 
                value='{$jogo['empresa']}' class='form-control item' placeholder='Empresa'>
        </div>
            $img<br>
            <input type='file' name='figura' class='mt-5'>
            <br><br>
            <input type='hidden' name='id' value='$id'>

            <input type='submit' value='Atualizar' name='btnAtualizar' class='btn btn-primary'><br><br>
            <a href='listarJogo.php' class='btn btn-secondary btn-lg active' role='button' aria-pressed='true'>Voltar</a>
        </form>
    </div>";   