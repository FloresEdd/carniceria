<?php
require "DataBase/conexion.php";

// get data form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    $name = $_POST["name"];
    $precio = $_POST["precio"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = $_FILES["imagen"]["type"];
    $tamanoImagen = $_FILES["imagen"]["size"];
    $tempImagen = $_FILES["imagen"]["tmp_name"];

    // verify the connection
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // prepare the query
    $stmt = $conn->prepare("INSERT INTO productos (name, precio) VALUES (?, ?)");

    // vincule data to declaration of variables
    $stmt->bind_param("si", $name, $precio);

    // execute the query
    $stmt->execute();

    // read the image
    $imagenContenido = file_get_contents($tempImagen);

    // pepare the image query
    $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);

    // vincule data to declaration of variables
    $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $imagenContenido);

    // execute the query
    $statement->execute();

    // close the statement and connection
    $statement->close();
    $stmt->close();
    $conn->close();

    // show successfull message
    echo "Registro exitoso";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <h1 align="center">REGISTRO DE PRODUCTOS</h1>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
</head>

<body>
    <form align="center" action="registro.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio"><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>

</html>