<?php
$host = 'localhost';
$db = 'turismo';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Parámetros para la paginación y el filtrado
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Consulta para contar los registros totales
$stmt = $pdo->prepare("SELECT COUNT(*) FROM tperosna WHERE tpNombre LIKE :filter OR tpApellido LIKE :filter OR tpCedula LIKE :filter");
$stmt->execute(['filter' => "%$filter%"]);
$totalCount = $stmt->fetchColumn();

// Consulta para obtener los registros filtrados y paginados
$stmt = $pdo->prepare("SELECT * FROM tperosna WHERE tpNombre LIKE :filter OR tpApellido LIKE :filter OR tpCedula LIKE :filter LIMIT :offset, :limit");
$stmt->bindValue('filter', "%$filter%", PDO::PARAM_STR);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->bindValue('limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Respuesta JSON

header("Content-Type: application/json");
echo json_encode([
    'totalCount' => $totalCount,
    'data' => $data
]);
