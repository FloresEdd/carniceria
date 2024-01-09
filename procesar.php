<?php
//connection to db
require "DataBase/conexion.php";
if (isset($_POST['productos']) && is_array($_POST['productos'])) {
    foreach ($_POST['productos'] as $productoId) {
        //get the info of each product by id
        //select the info of the product
        $sql = "SELECT name, precio, imagen FROM productos where id = $productoId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //process the result
            while ($row = $result->fetch_assoc()) {
                $nombre = $row['name'];
                $precio = $row['precio'];
                $imagen = $row['imagen'];
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Confirma tu producto!</title>
    <h1 align="center">INFORMACION DE TU COMPRA</h1>
</head>

<body>

</body>

</html>