<?php

session_start();
include("../../conexao.php");
if(!$_SESSION['user']) {
	header('Location: ../index.php');
	exit();
}

if (isset($_POST['usuario'])) {
    $nome = $_POST['usuario'];
}

if (isset($_POST['saldo'])) {
    $mensagem = $_POST['saldo'];
}


$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$saldo = mysqli_real_escape_string($conexao, trim($_POST['creditos']));


$sql = "select count(*) as total from usuarios where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);



if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: cadastrar.php');
	exit;
}


$sql = "INSERT INTO usuarios ( usuario, saldo ) VALUES ($usuario, $saldo)";


if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}else{
	$_SESSION['error_aocadastra'] = true;
}


$conexao->close();

header('Location: cadastrar.php');
exit;
?>