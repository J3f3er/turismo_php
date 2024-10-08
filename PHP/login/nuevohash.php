<?php
require_once "../conexion/conexion.php";
// La contraseña original que deseas usar
$password = '12345678';

// Genera un nuevo hash
$new_hash = password_hash($password, PASSWORD_BCRYPT);
echo "Nuevo Hash: " . $new_hash . "<br>";

$sql = "INSERT INTO tusuarios (tClv) VALUES (:tClv)";
$stmt = $pdo->prepare($sql);
$stmt->execute([':tClv' => $new_hash]);

// Verifica el hash generado
if (password_verify($password, $new_hash)) {
    echo 'La contraseña es válida con el nuevo hash.';
} else {
    echo 'La contraseña no es válida con el nuevo hash.';
}
?>
