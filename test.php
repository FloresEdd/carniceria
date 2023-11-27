<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carniceria";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Subir imagen
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = $_FILES["imagen"]["type"];
    $tamanoImagen = $_FILES["imagen"]["size"];
    $rutaImagen = $_FILES["imagen"]["tmp_name"];

    // Leer los datos de la imagen
    $imagen = file_get_contents($rutaImagen);
    
    // Preparar consulta SQL para insertar la imagen en la base de datos
    $query = "INSERT INTO imagenes (nombre, tipo, tamano, imagen) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("ssis", $nombreImagen, $tipoImagen, $tamanoImagen, $imagen);
    $statement->execute();
    
    echo "La imagen se ha subido correctamente.";
}

// Obtener todas las imágenes de la base de datos
$query = "SELECT nombre, tipo, imagen FROM imagenes";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombreImagen = $row["nombre"];
        $tipoImagen = $row["tipo"];
        $imagen = $row["imagen"];

        // Mostrar la imagen en la página web
        echo "<img src='data:$tipoImagen;base64," . base64_encode($imagen) . "' alt='$nombreImagen'>";
    }
} else {
    echo "No se encontraron imágenes en la base de datos.";
}

$conn->close();
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="imagen" accept="image/jpeg, image/png" required>
    <button type="submit">Subir Imagen</button>
</form>
