<?php
require "DataBase/conexion.php";

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar todos los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Consultar todas las imágenes
$sql2 = "SELECT * FROM imagenes";
$result2 = $conn->query($sql2);

// Verificar si hay productos
if ($result && $result2->num_rows > 0) {
    echo "<table>";
    echo "<tr>
        <th>Nombre del producto</th>
        <th>Imagen</th>
        <th>Precio</th>
    </tr>";

    // Obtener todas las imágenes
    $images = array();
    while ($row2 = $result2->fetch_assoc()) {
        $images[$row2["nombre"]] = "data:" . $row2["tipo"] . ";base64," . base64_encode($row2["imagen"]);
    }

    // Iterar todos los productos
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $precio = $row["precio"];

        // Encontrar la imagen correspondiente para el producto
        $imagen = isset($images[$name]) ? $images[$name] : "";

        // Mostrar los productos en la tabla
        echo "<tr>
            <td>$name</td>
            <td><img src='$imagen' alt='$name'></td>
            <td>$precio</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No hay productos";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>La principal</title>
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="es">
<meta charset=" UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>La principal </title>
</head>

<body>

</body>

</html>