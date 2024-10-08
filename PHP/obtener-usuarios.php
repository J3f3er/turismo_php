<?php
// Configuración de la base de datos usando PDO
$host = 'localhost';
$dbname = 'turismo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta a la base de datos
    $stmt = $pdo->query("SELECT tId, tNombre, tApellido, tUsuario, tEmail, creado_at, update_at, tAvatar FROM tusuarios WHERE tEmail LIKE '%@scoa%'");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devuelve los datos en formato JSON
    echo json_encode([
        "data" => $usuarios // DataTables requiere un campo "data"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "error" => "Error de conexión: " . $e->getMessage()
    ]);
}
