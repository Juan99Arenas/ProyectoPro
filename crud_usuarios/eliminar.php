<?php
include 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM citas WHERE id_cita = ?");
    $stmt->execute([$id]);
}
header('Location: index.php');
exit;