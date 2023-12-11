<?php
require "DataBase/conexion.php";

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar la consulta SQL para seleccionar los datos
$sql = "SELECT name, precio, imagen FROM productos";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Precio</th><th>Imagen</th></tr>";

    // Recorrer los resultados y mostrar los datos en una tabla
    while ($row = $result->fetch_assoc()) {
        $nombre = $row["name"];
        $precio = $row["precio"];
        $imagen = $row["imagen"];

        echo "<tr>";
        echo "<td>$nombre</td>";
        echo "<td>$precio</td>";
        echo "<td><img widht='100px' height='100px'src='data:image/PNG;base64," . base64_encode($imagen) . "' alt=''></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>La principal</title>

</head>

<body>

</body>