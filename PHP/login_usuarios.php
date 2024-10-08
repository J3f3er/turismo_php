<?php
session_start();
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=localhost;dbname=turismo', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tUsuario = $_POST['tUsuario'];
    $tUsuario_password = $_POST['tUsuario_password'];
    $remember = isset($_POST['remember']);

    $sql = "SELECT tId, tUsuario_password FROM tusuarios WHERE tUsuario = :tUsuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':tUsuario' => $tUsuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($tUsuario_password, $user['tUsuario_password'])) {
        $_SESSION['user_id'] = $user['tId'];

        if ($remember) {
            setcookie('user_id', $user['tId'], time() + (86400 * 30), "/");
        }

        echo json_encode(['success' => 'Login exitoso']);
    } else {
        echo json_encode(['error' => 'Usuario o contraseña incorrectos']);
    }
}
?>
