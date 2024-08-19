<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'template/cabecera.php';
?>

<?php 
$total = 0;
if($_POST){
    
    $SID = session_id(); // devuelve una clave de la sesión
    $Correo = $_POST['email'];

    foreach($_SESSION['CARRITO'] as $indice => $producto){
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $sentencia = $pdo->prepare("INSERT INTO `ventas` (`id`, `clave_transaccion`, `datospagos`, `fecha`, `correo`, `total`, `status`) VALUES (NULL, :clave_transaccion, '', NOW(), :correo, :total, 'pendiente');");

    $sentencia->bindParam(":clave_transaccion", $SID);
    $sentencia->bindParam(":correo", $Correo);
    $sentencia->bindParam(":total", $total);
    $sentencia->execute();
    $idVentas=$pdo->lastInsertId();

    foreach($_SESSION['CARRITO'] as $indice => $producto){

        $sentencia = $pdo->prepare ("INSERT INTO `detalleventa` (`id`, `idVenta`, `idProducto`, `precioUnitario`, `cantidad`, `descargado`) VALUES (NULL, :idVenta, :idProducto, :precioUnitario, :cantidad, '0');");
    
        $sentencia->bindParam(":idVenta", $idVentas);
        $sentencia->bindParam(":idProducto", $producto['ID']);
        $sentencia->bindParam(":precioUnitario", $producto['PRECIO']);
        $sentencia->bindParam(":cantidad", $producto['CANTIDAD']);
        $sentencia->execute();

    
    }

   // echo "<h3>".$total."</h3>";
}
?>

<script src="https://www.paypal.com/sdk/js?client-id="></script>

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>


<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar la cantidade de : <h4>$<?php echo number_format($total,2); ?></h4>

      <div id="paypal-button-container"></div>
    </p>
 
    <p>Los productos seran enviados una vez que se procese el pago <strong>(para aclaraciones: aaaa@gmail.com)</strong></p>
</div>

<div id="paypal-button-container"></div>
 
<script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'vertical',
            label: 'checkout',
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total; ?>', // Total a pagar
                        currency_code: 'ARS' // Especifica la moneda como Pesos Argentinos
                    },
                    description: "Compra de productos a Tienda",
                    custom_id: "Codigo"
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                window.location = "verificador.php?orderID=" + data.orderID;
            });
        },
        onError: function(err) {
            console.error('Error:', err);
        }
    }).render('#paypal-button-container');
</script>

<?php include 'template/pie.php';?>
