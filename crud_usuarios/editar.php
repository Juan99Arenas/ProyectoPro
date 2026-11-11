<?php
include 'includes/conexion.php';

// 1. Obtener el ID de la cita a editar de manera segura
$id = filter_var($_GET['id'] ?? $_POST['id'] ?? null, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

// 2. Si se envió el formulario (Actualizar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha_hora'];

    $stmt = $pdo->prepare("UPDATE citas SET fecha_hora = ? WHERE id_cita = ?");
    $stmt->execute([$fecha, $id]);

    header('Location: index.php');
    exit;
}

// 3. Consultar los datos actuales de la cita y del paciente
$stmt = $pdo->prepare("SELECT c.*, p.nombre FROM citas c JOIN pacientes p ON c.id_paciente = p.id_paciente WHERE c.id_cita = ?");
$stmt->execute([$id]);
$cita = $stmt->fetch();

if (!$cita) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
</head>
<body style="padding: 20px;">
    <h3>Editar Cita de: <?= htmlspecialchars($cita['nombre']) ?></h3>
    
    <form method="POST">
        <input type="hidden" name="id" value="<?= $cita['id_cita'] ?>">

        <label>Fecha y Hora:</label><br>
        <!-- Formateamos la fecha para que el input datetime-local la reconozca -->
        <input type="datetime-local" name="fecha_hora" value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_hora'])) ?>" required><br><br>

        <button type="submit">Actualizar Cita</button>
    </form>
    <br>
    <a href="index.php">Volver</a>
</body>
</html>