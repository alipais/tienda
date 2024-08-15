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
                   <a class="nav-link" href="mostrarCarrito.php">Carrito(<?php 
                   echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)</a>
                  </li>
                </ul>        
            </div>
    </nav>
    <br/>
    <br/>
    <div class="container">