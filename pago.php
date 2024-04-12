<?php
//file that contains the db connection 
require "DataBase/conexion.php";
//verify the connection
if ($conn->connect_error) {
    die("Error a la hora de conectar la base de datos: " . $conn->connect_error);
}
//receive the form data
$nombre = $_POST["nombre"];
$numerosTarjeta = $_POST["numerosTarjeta"];
$vigencia = $_POST["vigencia"];
$cvv = $_POST["cvv"];
$sql = $conn->prepare("INSERT INTO pago (nombre_comprador, numeros_tarjeta, vigencia, cvv) VALUES (?, ?, ?, ?)");
$sql->bind_param("ssss", $nombre, $numerosTarjeta, $vigencia, $cvv);
//execute the query
$sql->execute();
//close the connection
$sql->close();
$conn->close();
//session start
session_start();
//access to the information of the products saved on the session
$datosProducto = $_SESSION['producto'];
//access to data individually
$nombre = $_SESSION['producto']["name"];
$precio = $_SESSION['producto']["precio"];
$imagen = $_SESSION['producto']["imagen"];

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Tus productos esperan por ti!</title>
</head>

<body>

    <h1>Detalles del Producto</h1>
    <?php
    foreach ($_SESSION['producto'] as $datosProducto) {
        echo "<p>Nombre: " . $datosProducto['name'] . "</p>";
        echo "<p>Precio: " . $datosProducto['precio'] . "</p>";
        echo "<img src='" . $datosProducto['imagen'] . "' alt='Imagen del producto'>";
    }
    ?>
</body>

</html>