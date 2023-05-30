<?php
// error_reporting(0);
session_start();
if(!$_SESSION['user']) {
	header('Location: ../index.php');
	exit();
}
include_once("../../conexao.php");
$perfil = '1.jpg';
$ip = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Listagem de usuários</title>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	
		<link rel="stylesheet" href="css/estilo.css">
	</head>
<link rel="icon" href="<?php echo $perfil; ?>">
<div class="text-center mb-3">
    <img src="<?php echo $perfil; ?>" class="rounded-circle" width="180">


</div>
</div>
    </div>
<div class="container mt-4" style="margin-bottom: 100px;">
	<body>
		<div class="container-fluid">

			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Menu
				</a>
			    
			  <div class="dropdown-menu" style="color: rgb(255, 255, 255);" aria-labelledby="dropdownMenuLink">
				  <a class="dropdown-item" style="color: rgb(255, 255, 255);" href="cadastrar.php">Cadastrar</a>
				  <a class="dropdown-item" style="color: rgb(255, 255, 255);" href="index.php">Atualizar</a>
                 <a class="dropdown-item" style="color: rgb(255, 255, 255);" href="../../file.php">Editar bot</a>
				  <a class="dropdown-item" style="color: rgb(255, 255, 255);" href="../../">Sair</a>
				</div>

			    <center><h3>Lista de Usuários</h3></center>
			<font color="#B22222">Copia oque eu faço, mais não faz oque eu faço. 😎 </font>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}


		$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
		$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
		$qnt_result_pg = 8;
		$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

		?>

                                
<div class="table-responsive">
<table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">Chat Id</th>
      <th scope="col">Saldo</th>
	 <th scope="col">Apagar</th>
	 <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
  		
		
		<?php
		$result_usuarios = "SELECT * FROM usuarios LIMIT $inicio, $qnt_result_pg";
		$resultado_usuarios = mysqli_query($conexao, $result_usuarios);
		while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
		?>
					<tr>
					<th scope="row"><?php echo $row_usuario['usuario'];?></td>
						<td><?php echo $row_usuario['saldo'];?></td>
						<td><?php echo "<a href='apagar_usuario.php?id=" . $row_usuario['id'] . "'><button type='button' class='btn btn-outline-danger'>🗑️</button></a>" ?></td>
						<td><?php echo "<a href='editar/edit_usuario.php?id=" . $row_usuario['id'] . "'><button type='button' class='btn btn-outline-secondary'>📝</button></a>" ?></td>
					</tr>
    		<?php }?>
  </tbody>
</table>
</div>
 

		<?php	
		//Paginção - Somar a quantidade de usuários
		$result_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
		$resultado_pg = mysqli_query($conexao, $result_pg);
		$row_pg = mysqli_fetch_assoc($resultado_pg);




		//echo $row_pg['num_result'];
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		


		//Limitar os link antes depois
		$max_links = 2;
		echo "<a class='pagi' href='index.php?pagina=1'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a class='pagi' href='index.php?pagina=$pag_ant'>$pag_ant</a> ";
			}
		}



		echo "$pagina ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a class='pagi' href='index.php?pagina=$pag_dep'>$pag_dep</a> ";
			}
		}
		
		echo "<a class='pagi' href='index.php?pagina=$quantidade_pg'>Ultima</a>";
		
		?>	
<h6> Desenvolvido por https://t.me/K3nny_McC0rm1ck </h6>

</div>
	</body>
</html>