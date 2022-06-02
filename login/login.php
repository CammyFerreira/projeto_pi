<?php
session_start();
require_once '../conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $bd->prepare("  SELECT senha, email
                        FROM usuarios 
                        WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$val = $stmt->fetch(PDO::FETCH_ASSOC);


if( password_verify( $senha, $val['senha']) ){

    $_SESSION['email'] = $email;

    header('location: ../jogo/listarJogo.php');

}else{

    echo "Credenciais inválidas";
}
