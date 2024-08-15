<?php 
session_start();
$mensaje="";
$ID = null; // Inicializar la variable $ID

if(isset($_POST['btnAccion'])){ // si hacemos una recepción POST
switch($_POST['btnAccion']){
   
    case 'Agregar':

if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
$ID= openssl_decrypt($_POST['id'],COD,KEY);
$mensaje.= "Ok.... ID correcto".$ID ."<br/>";
}else{
$mensaje.= "Upss.... ID incorrecto".$ID ."<br/>";
}

if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
    $NOMBRE= openssl_decrypt($_POST['nombre'],COD,KEY);
    $mensaje.= "OK.... nombre correcto".$NOMBRE ."<br/>";
    }else{
    $mensaje.= "Upss.... nombre incorrecto" ."<br/>";      
break;
    }

    if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
        $CANTIDAD= openssl_decrypt($_POST['cantidad'],COD,KEY);
        $mensaje.= "OK.... CANTIDAD correcto".$CANTIDAD ."<br/>";
        }else{
        $mensaje.= "Upss.... cantidad incorrecto"."<br/>";                
break;
        }
        
        if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
            $PRECIO= openssl_decrypt($_POST['precio'],COD,KEY);
            $mensaje.= "OK.... precio correcto".$PRECIO ."<br/>";
            }else{
            $mensaje.= "Upss.... precio incorrecto" ."<br/>";                   
break;
            }

            if(!isset($_SESSION['CARRITO'])){
                $_SESSION['CARRITO'] = array();
            

            $producto = array(
                'ID' => $ID,
                'NOMBRE' => $NOMBRE,
                'CANTIDAD' => $CANTIDAD,
                'PRECIO' => $PRECIO,
            );

            $_SESSION['CARRITO'][0] = $producto;
           
           $mensaje = "Producto agregado al carrito";  
        }else {

            $idProductos=array_column($_SESSION['CARRITO'],"ID");
        }
            if(in_array($ID,$idProductos)){
             echo "<script>alert('El producto ya ha sido seleccionado');</script>";
             $mensaje="";
            }else{
            $NumeroProductos=count($_SESSION['CARRITO']);
            $producto = array(
                'ID' => $ID,
                'NOMBRE' => $NOMBRE,
                'CANTIDAD' => $CANTIDAD,
                'PRECIO' => $PRECIO,
            );
            $_SESSION['CARRITO'][$NumeroProductos] = $producto;

        }
// $mensaje = print_r($_SESSION,true);
$mensaje = "Producto agregado al carrito"; 

break;
    case'Eliminar':
    if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
        $ID= openssl_decrypt($_POST['id'],COD,KEY);
        $mensaje.= "Ok.... ID correcto".$ID ."<br/>";
        
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
          if($producto['ID']==$ID){
            unset($_SESSION['CARRITO'][$indice]);
            echo "<script> alert('Elemento borrado...');</script>";
          }
        }
    
    }else{
        $mensaje.= "Upss.... ID incorrecto".$ID ."<br/>";
        }
break;
}

}
?>
<?php include 'template/pie.php'; ?>