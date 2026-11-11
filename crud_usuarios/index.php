<?php
include 'includes/conexion.php';
// Consultar las citas existentes
$citas = $pdo->query("SELECT c.id_cita, p.nombre, c.fecha_hora FROM citas c JOIN pacientes p ON c.id_paciente = p.id_paciente")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MediCitas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="padding: 20px;">
        <h2>Listado de Citas Médicas</h2>
        <a href="agendar.php">+ Agendar Nueva Cita</a>
        <table border="1" cellpadding="10" style="margin-top: 15px; width: 100%;">
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Fecha y Hora</th>
                <th>Acción</th>
            </tr>
            <?php foreach ($citas as $c): ?>
            <tr>
                <td><?= $c['id_cita'] ?></td>
                <td><?= $c['nombre'] ?></td>
                <td><?= $c['fecha_hora'] ?></td>
                <td>
                    <!-- Botón Editar -->
                    <a href="editar.php?id=<?= $c['id_cita'] ?>">Editar</a> | 
                    
                    <!-- Botón Eliminar -->
                    <form action="eliminar.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar cita?');">
                        <input type="hidden" name="id" value="<?= $c['id_cita'] ?>">
                        <button type="submit" style="background:none;color:red;border:none;cursor:pointer;padding:0;">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>