<?php
include 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $fecha = $_POST['fecha_hora'];

    // 1. Guardar paciente
    $stmt = $pdo->prepare("INSERT INTO pacientes (nombre, dni) VALUES (?, ?)");
    $stmt->execute([$nombre, $dni]);
    $id_paciente = $pdo->lastInsertId();

    // 2. Guardar cita
    $stmtC = $pdo->prepare("INSERT INTO citas (id_paciente, fecha_hora) VALUES (?, ?)");
    $stmtC->execute([$id_paciente, $fecha]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Agendar</title></head>
<body style="padding: 20px;">
    <h3>Nueva Cita</h3>
    <form method="POST">
        <label>Nombre del Paciente:</label><br>
        <input type="text" name="nombre" required><br><br>
        
        <label>DNI:</label><br>
        <input type="text" name="dni" required><br><br>

        <label>Fecha y Hora:</label><br>
        <input type="datetime-local" name="fecha_hora" required><br><br>

        <button type="submit">Guardar</button>
    </form>
    <br><a href="index.php">Volver</a>
</body>
</html>