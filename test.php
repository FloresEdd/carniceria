<?php
require "DataBase/conexion.php";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    $nombreImagen = $_FILES['imagen']['name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamanoImagen = $_FILES['imagen']['size'];
    $tempImagen = $_FILES['imagen']['tmp_name'];

    //verify if the file is an image
    if($tipoImagen == "image/jpeg" || $tipoImagen == "image/png") {
        // save the image on db
        $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $tempImagen);
        $statement->execute();
        $statement->close();
        
        echo "Imagen subida exitosamente";
    } else {
        echo "Sólo se permiten archivos JPEG y PNG";
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="imagen" accept="image/jpeg, image/png" required>
    <button type="submit">Subir Imagen</button>
</form>
