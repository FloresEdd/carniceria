<?php
require "DataBase/conexion.php";

// gte the data of form
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

    // prepare the SQL statement to insert the data
    $stmt = $conn->prepare("INSERT INTO productos (name, precio) VALUES (?, ?)");

    // link the data to the statement
    $stmt->bind_param("si", $name, $precio);

    // execute the statement of product
    $stmt->execute();

    // prepare the query to images table
    $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);

    // link the data to variables
    $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $tempImagen);

    // execute the query to insert the image
    $statement->execute();

    // close the connection and statement
    $statement->close();
    $stmt->close();
    $conn->close();

    // Mostrar mensaje de éxito
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