
<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">	
    <script> src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" </script>
</head>
<body>
   <nav class="navbar navbar-expand navbar-light fixed-top">        
            <a class="navbar-brand"  href="index.php">Logo de la empresa</a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse">
            </button>         
           <div id=""my-nav class="collapse navbar-collapse">
               <ul class=" navbar-nav mr-auto">
                  <li class=" nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                  </li>
                  <li class=" nav-item active">
                   <a class="nav-link" href="#">Carrito</a>
                  </li>
                </ul>        
            </div>
    </nav>
    <br/>
    <br/>
    <div class="container">
     <br>
        <div class="alert alert-success" role="alert">     
         <?php echo $mensaje; ?>
           
         <a href="#" class="badge badge-success">Ver carrito</a>
        </div>
        <div class="row">
          <?php 
          $sentencia=$pdo->prepare("SELECT * FROM `productos`");
          $sentencia->execute();//ejecuta la sentecia select
          $listaproducto=$sentencia->fetchAll(PDO::FETCH_ASSOC);
          //print_r($listaproducto);
          ?>

          <?php 
          foreach($listaproducto as $producto) {?>
           <div class="col-3">
              <div class="card">              
                 <img 
                 title="<?php echo $producto['nombre'];?>"alt="<?php echo $producto['nombre'];?> "class="card-img-top" src="<?php echo $producto['imagen'];?>"
                 data-toggle="popover"
                 data-trigger="hover"
                 data-content="<?php echo $producto['descripcion'];?>"
                 >
                                 
                  <div class="card-body">
                    <p><?php echo $producto['nombre'];?></p>
                    
                     <h5 class="card-title">$<?php echo $producto['precio'];?></h5>
                     <p class="card-text">Decripcion</p>

                     <form action="" method="post">
                      <input type="text" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'],COD, KEY) ;?>">
                      <input type="text" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD, KEY);?>">
                      <input type="text" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD, KEY);?>">
                      <input type="text" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD, KEY);?>">

                     <button class="btn btn-primary"name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                     </form>
                     
                 
                    </div>
              </div>
            </div>
          <?php } ?>

            

        </div>    
    </div>
    <script>
      $(function () {
  $('[data-toggle="popover"]').popover()
})
    </script>
</body>
</html>