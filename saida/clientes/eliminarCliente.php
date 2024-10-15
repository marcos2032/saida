<?php
include "../conexionMysql.php"; // Asegúrate de que la ruta sea correcta

if (isset($_POST['idcliente'])) {
    $idcliente = $_POST['idcliente'];

    $sql = $conexion->prepare("DELETE FROM clientes WHERE idcliente = ?");
    if (!$sql) {
        echo "Error en la preparación: " . $conexion->error;
        exit;
    }

    $sql->bind_param("i", $idcliente);
    $success = $sql->execute();

    if ($success) {
        echo "Cliente eliminado correctamente.";
    } else {
        echo "Error al eliminar el cliente: " . $sql->error;
    }

    $sql->close();
    $conexion->close();
} else {
    echo "No se recibió el ID del cliente.";
}
?>


