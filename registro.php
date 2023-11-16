<?php
require "DataBase/conexion.php";

// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $tmp_image = $_FILES["image"]["tmp_name"];
    $precio = $_POST["precio"]; // cambiar el nombre de la variable

    // Leer la imagen en bytes
    $data_image = file_get_contents($tmp_image);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la sentencia SQL
    $stmt = $conn->prepare("INSERT INTO productos (name, image, precio) VALUES (?, ?, ?)");

    // Vincular los parámetros a la sentencia SQL
    $stmt->bind_param("sbi", $name, $data_image, $precio); // cambiar la variable $price por $precio

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "Imagen subida correctamente";
    } else {
        echo "Error al subir la imagen: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
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
    <form align="center" action="registro.php" method="POST">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="image" name="image"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio"><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>

</html>