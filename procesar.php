<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/procesar.css">
    <title>¡Confirma tu producto!</title>

    <style>
        .product-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-info {
            width: 50%;
        }

        .product-image {
            width: 50%;
            text-align: right;
        }

        .product-image img {
            width: 50%;
            height: auto;
        }

        .links {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 align="center">INFORMACION DE TU COMPRA</h1>

    <?php
    //connection to db
    require "DataBase/conexion.php";
    if (isset($_POST['productos']) && is_array($_POST['productos'])) {
        foreach ($_POST['productos'] as $productoId) {
            //get the info of each product by id
            //select the info of the product
            $sql = "SELECT name, precio, imagen FROM productos where id = $productoId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                //process the result
                while ($row = $result->fetch_assoc()) {
                    $nombre = $row['name'];
                    $precio = $row['precio'];
                    $imagen = $row['imagen'];

                    //show the image and info of the product
                    echo "<div class='product-container'>";
                    echo "<div class='product-info'>";
                    echo "<h3>" . $nombre . "</h3>";
                    echo "<p>Precio: $" . $precio . "</p>";
                    echo "</div>";
                    echo "<div class='wrapper'>";
                    echo "<span class='minus'>-</span>";
                    echo "<div class='product-image'>";
                    echo "<img src='data:image/PNG;base64," . base64_encode($imagen) . "' alt='Imagen'>";
                    echo "<span class='num'>01</span>";
                    echo "<span class='plus'>+</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
    } else {
        //If there arent products
        echo "No se encontraron productos";
    }
    $conn->close();
    ?>
    <div class="links">
        <a href="index.php">¿Quieres seleccionar más productos?</a>
    </div>
</body>
<script src="Js/script.js"></script>

</html>