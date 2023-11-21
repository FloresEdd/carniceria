<?php
require "DataBase/conexion.php";

//verify the connection
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
//coonsult all products
$sql  = "SELECT * FROM productos";
$result = $conn->query($sql);
//consult all images
$sql2  = "SELECT * FROM imagenes";
$result2 = $conn->query($sql2);
//verify if there are products
if ($result && $result2->num_rows > 0) {
    echo "<table>";
    echo "<tr>
<th>
Nombre del producto
</th>
<th>
Imagen
</th>
<th>
Precio
</th>";
    //iterate all products
    while ($row = $result->fetch_assoc()) {
        if (is_array($row)) {
            $name = $row["name"];
            $imagen = $row["imagen"];
            $precio = $row["precio"];
            //show the products
            echo "<tr>
            <td>$name</td>
            <td><img src='$imagen' width='100' height='100'></td>
            <td>$precio</td>
            </tr>";
        }
    }
    echo "</table>";
} else {
    echo "No hay productos";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<meta charset=" UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>La principal </title>
</head>

<body>

</body>

</html>