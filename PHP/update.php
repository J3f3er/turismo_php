<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $paid = isset($_POST['paid']) ? 1 : 0;

    if ($id && $name && $email) {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, paid = :paid WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'paid' => $paid]);

        echo json_encode(['status' => 'success', 'message' => 'Registro actualizado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    }
}
?>
