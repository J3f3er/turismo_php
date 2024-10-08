<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $paid = isset($_POST['paid']) ? 1 : 0;

    if ($name && $email) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, paid) VALUES (:name, :email, :paid)");
        $stmt->execute(['name' => $name, 'email' => $email, 'paid' => $paid]);

        echo json_encode(['status' => 'success', 'message' => 'Registro creado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    }
}
?>
