<?php
session_start();
include "../conexionMysql.php"; // Verifica que la ruta sea correcta

// Verifica que la conexión se haya establecido
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $idProducto = $_POST['idproducto'];
    $nombre = $_POST['productName'];
    $precio = $_POST['productPrice'];
    $categoria = $_POST['productCategory'];
    $cantidad = $_POST['productQuantity'];
    $descripcion = $_POST['productDescription']; // Nuevo campo de descripción

    // Valida que los datos no estén vacíos
    if (empty($idProducto) || empty($nombre) || empty($precio) || empty($categoria) || empty($cantidad) || empty($descripcion)) {
        // Redirige con un mensaje de error
        header("Location: productos.php?error=1");
        exit;
    }

    // Escapa los datos para evitar inyecciones SQL
    $idProducto = $conexion->real_escape_string($idProducto);
    $nombre = $conexion->real_escape_string($nombre);
    $precio = $conexion->real_escape_string($precio);
    $categoria = $conexion->real_escape_string($categoria);
    $cantidad = $conexion->real_escape_string($cantidad);
    $descripcion = $conexion->real_escape_string($descripcion); // Escapar la descripción

    // Actualiza el producto en la base de datos
    $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', id_categoria='$categoria', cantidad='$cantidad', descripcion='$descripcion' WHERE id_producto='$idProducto'"; // Añadir descripción

    if ($conexion->query($sql) === TRUE) {
        // Redirige de vuelta a la página de gestión de productos
        header("Location: productos.php?success=1");
        exit;
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
}

// Cierra la conexión
$conexion->close();
?>

