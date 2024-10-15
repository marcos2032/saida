<?php
session_start(); // Iniciar la sesión
include "../conexionMysql.php"; // Verifica que la ruta sea correcta

// Verifica que la conexión se haya establecido
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del producto a eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idproducto'])) {
    $idProducto = $_POST['idproducto'];

    // Preparar la consulta para eliminar el producto
    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProducto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>




