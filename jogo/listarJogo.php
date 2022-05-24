<?php
// require '../controleDeAcesso.php';
require '../conexao.php';
require 'buscar.php';

$stmt = $bd->query('SELECT id, nome, descricao, imagem FROM jogo WHERE apagado = 0');

$stmt->execute();

echo "<a href='../jogo/formJogo.php'>+ Novo Jogo</a>
        <section>
          <form method='get'>
            <div class= 'row my-4'>
              <div class='col'>
                <label>Buscar por título</label>
                <input type='text' name='busca' class='form-control' value='$busca'>
                </div>
        <div class='col'>
        <label>Categoria</label>
        <select name='status' class='form-control'>
                <option value=''>Todas<option>
                <option value='t' $filtroStatus == 't' ? 'selected' : ''>Terror<option>
                <option value='a'>FPA<option>
                <option value='m'>Moba<option>
                <option value='f'>FPS<option>
                <option value='b'>Battle Royale<option>
                <option value='p'>PVP<option>
                <option value='r'>RPG<option>
        </select>
        </div>
              
            <div class='col'>
                <button type='submit' class='btn btn-primary'>Filtrar</button>
             </div>
        </div>
          </form>
        </section>

        <form method='post'>
        <table border='1'>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Descrição</td>
            <td>Imagem</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>";

while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){

    $img = 'N/D';    

    if(!empty($reg['imagem'])){
        if(is_file($reg['imagem'])){
                $img = "<img src='{$reg['imagem']}' width='50' height='50'>";
        }
    }    

    echo "  <tr>
                <td>{$reg['id']}</td>
                <td>{$reg['nome']}</td>
                <td>{$reg['descricao']}</td>
                <td>$img</td>
                <td><button name='id' formaction='editarJogo.php' 
                        value='{$reg['id']}'>Editar</button></td>
                <td><button name='id' formaction='apagaJogo.php' 
                        value='{$reg['id']}'>Apagar</button></td>
            </tr>";
}

// echo "<table></form><br><a href='index.php'>Menu</a>";