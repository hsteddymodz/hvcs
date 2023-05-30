<?php

session_start();

include("../conexao.php");


if (isset($_POST['user'])) {
    $nome = $_POST['user'];
}

if (isset($_POST['chave'])) {
    $mensagem = $_POST['chave'];
}


if(empty($_POST['user']) || empty($_POST['chave'])) {
	header('Location: index.php');
	exit();
}


$usuario = mysqli_real_escape_string($conexao, $_POST['user']);
$senha = mysqli_real_escape_string($conexao, $_POST['chave']);

$query = "select user from admin where user = '{$usuario}' and chave = md5('{$senha}')";

$result = mysqli_query($conexao, $query);


if(mysqli_num_rows($result) == 1) {
	$_SESSION['user'] = $usuario;
	header('Location: painel/
	');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}
?>