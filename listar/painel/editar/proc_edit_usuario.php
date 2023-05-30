<?php
session_start();
include("../../../conexao.php");
if(!$_SESSION['user']) {
	header('Location: ../index.php');
	exit();
}


$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$creditos = filter_input(INPUT_POST, 'creditos', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);


$result_usuario = "UPDATE usuarios SET saldo= $creditos, usuario= '$usuario' WHERE id='$id'";
$resultado_usuario = mysqli_query($conexao, $result_usuario);

if(mysqli_affected_rows($conexao)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
	header("Location: ../index.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuário não foi editado </p>";
	header("Location: ../index.php");
}
?>