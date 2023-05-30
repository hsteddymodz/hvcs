<?php
session_start();
include_once("../../../conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuario = "SELECT * FROM usuarios WHERE id = $id";
$resultado_usuario = mysqli_query($conexao, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
$perfil = '1.jpg';
?>

<html>


    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editor @M0h4mm3dzinho_bot</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../../../estilo/style.css">
        
    </head>
    



    <body>
        
        <div class="login-dark">
     
            <form method="POST" action="proc_edit_usuario.php">

                <h2 class="sr-only">Entrar</h2>


                
<link rel="icon" href="<?php echo $perfil; ?>">
<div class="text-center mb-3">
    <img src="<?php echo $perfil; ?>" class="rounded-circle" width="180">

                <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">



                <div class="form-group">
                    <input class="form-control" required="required" name="usuario" value="<?php echo $row_usuario['usuario']; ?>">
                </div>



                <div class="form-group">
                    <input type="number" min="1" max="1000" class="form-control form-control-user creditos" name="creditos" value="<?php echo $row_usuario['saldo']; ?>">
                </div>

                <div class="form-group">
                    <button class="btn btn-outline-white" type="submit">Editar</button>
                </div>

                <a href="../../../index.php" class="forgot">Login</a>
                
                </form>
    
        </div>
    
        
    
    
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
    
 </html>
