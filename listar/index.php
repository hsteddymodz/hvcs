
<?php
error_reporting(0);
session_start();
$perfil = '1.jpg';
?>
<html>


    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login de Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="style.css">
        
        
    </head>
    
       <body style="background-color: black;">
        
        <div class="login-dark">

            
            <form method="POST" action="login_admin.php">

                <?php
                if ($_SESSION['nao_autenticado']):
                ?>
                        <p>Sua chave está incorreta!</p>
                <?php 
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>
                
                
                
                <h2 class="sr-only">Entrar</h2>

                
<link rel="icon" href="<?php echo $perfil; ?>">
<div class="text-center mb-3">
    <img src="<?php echo $perfil; ?>" class="rounded-circle" width="180">


                <div class="form-group">
                    <input class="form-control" required="required" name="user" placeholder="Usúario">
                </div>
                <div class="form-group">
                    <input class="form-control" required="required" type="password" name="chave" placeholder="Chave de Admin">
                </div>



                <div class="form-group">
                    <button class="btn btn-outline-white" type="submit">Entrar</button>
                </div>

                
                </form>
 
        </div>
    
        
    
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
    
 </html>




?>