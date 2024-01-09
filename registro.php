<?php
require "DataBase/conexion.php";

//get data form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    $name = $_POST["name"];
    $precio = $_POST["precio"];
    $tempImagen = $_FILES["imagen"]["tmp_name"];
    $id = $_POST ["id"];

    //verify connection
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    //verify if the image is a png
    $tipoImagen = exif_imagetype($tempImagen);
    if ($tipoImagen !== IMAGETYPE_PNG) {
        die("Solo se permiten imágenes PNG");
    }

    // read image
    $imagenContenido = file_get_contents($tempImagen);

    // prepare query
    $stmt = $conn->prepare("INSERT INTO productos (name, precio, imagen, id) VALUES (?, ?, ?, ?)");

    // link parameters
    $stmt->bind_param("siss", $name, $precio, $imagenContenido, $id);

    // execute query
    $stmt->execute();

    // close statement and connection
    $stmt->close();
    $conn->close();

    // exit message
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
    <h2 align="center">SOLO SE PERMITEN IMAGENES .PNG</h2>
    <form align="center" action="registro.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio"><br><br>

        <label for="id">ID:</label>
        <input type="number" id="id" name="id"><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>

</html>