<?php
require "DataBase/conexion.php";

// Obtener la información del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    $name = $_POST["name"];
    $precio = $_POST["precio"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = $_FILES["imagen"]["type"];
    $tamanoImagen = $_FILES["imagen"]["size"];
    $tempImagen = $_FILES["imagen"]["tmp_name"];

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar el producto
    $stmt = $conn->prepare("INSERT INTO productos (name, precio) VALUES (?, ?)");

    // Vincular los datos a los parámetros de la consulta
    $stmt->bind_param("si", $name, $precio);

    // Ejecutar la consulta para insertar el producto
    $stmt->execute();

    // Preparar la consulta SQL para insertar la imagen
    $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);

    // Vincular los datos a los parámetros de la consulta
    $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $tempImagen);

    // Ejecutar la consulta para insertar la imagen
    $statement->execute();

    // Cerrar la conexión y el statement
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