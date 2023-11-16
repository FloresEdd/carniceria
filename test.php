<?php
require "DataBase/conexion.php";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    $nombreImagen = $_FILES['imagen']['name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamanoImagen = $_FILES['imagen']['size'];
    $tempImagen = $_FILES['imagen']['tmp_name'];

    // Verificar si la imagen es válida
    if($tipoImagen == "image/jpeg" || $tipoImagen == "image/png") {
        // Guardar la imagen en la base de datos
        $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $tempImagen);
        $statement->execute();
        $statement->close();
        
        echo "Imagen subida exitosamente";
    } else {
        echo "Sólo se permiten archivos JPEG y PNG";
    }
}
?>
?>