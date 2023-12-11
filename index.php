<?php
require "DataBase/conexion.php";

// verify the connection
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// prepare query
$sql = "SELECT name, precio, imagen FROM productos";
$result = $conn->query($sql);

//verify if there have results
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Precio</th><th>Imagen</th></tr>";

    // show results on a board
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

// close connection
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