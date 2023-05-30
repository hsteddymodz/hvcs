<?php
session_start();
error_reporting(0);
if(!$_SESSION['user']) {
	header('Location: ../index.php');
	exit();
}
$perfil = '1.jpg';
?>

<html>


    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro @M0h4mm3dzinho_bot </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../../estilo/style.css">

    </head>
    



    <body>
        
        <div class="login-dark">
     
            <form method="POST" action="cadastro.php">

                <h2 class="sr-only">Entrar</h2>


                <?php
                if ($_SESSION['status_cadastro']):
                ?>
               <p><font color="#13FF00">Cadastro efetusdo com sucesso </font></p>

                <?php 
                endif;
                unset($_SESSION['status_cadastro']);
                ?>
                <?php
                if ($_SESSION['usuario_existe']):
                ?>
                        <p><font color="#B22222">O Usuario Ja Existe </font></p>
                <?php 
                endif;
                unset($_SESSION['usuario_existe']);
                ?>

                <?php
                if ($_SESSION['error_aocadastra']):
                ?>
                    <p><font color="#B22222">Erro ao cadastrar usuario </font></p>
                <?php 
                endif;
                unset($_SESSION['error_aocadastra']);
                ?>

                
                <link rel="icon" href="<?php echo $perfil; ?>">
<div class="text-center mb-3">
    <img src="<?php echo $perfil; ?>" class="rounded-circle" width="180">

                <div class="form-group">
                    <input class="form-control" required="required" name="usuario" placeholder="id">
                </div>

                <div class="form-group">
                    <input type="number" min="1" max="1000" class="form-control form-control-user creditos" name="creditos" placeholder="Creditos">
                </div>

                <div class="form-group">
                    <button class="btn btn-outline-white" type="submit">Cadastrar</button>
                </div>

                <a href="index.php" class="forgot">Login</a>
                <a href="https://t.me/M0h4mm3dzinho_bot" class="forgot">Desenvolvedor</a>
                
                </form>
    
        </div>
    
        
    
    
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
    
 </html>