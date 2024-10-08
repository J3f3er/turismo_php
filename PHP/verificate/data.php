<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'turismo';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => "Error de conexión: " . $e->getMessage()]));
}

// Variables de paginación
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Contar el total de registros
$sqlCount = "SELECT COUNT(*) FROM tperosna WHERE tpNombre LIKE :search";
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->bindValue(':search', "%$search%");
$stmtCount->execute();
$totalRecords = $stmtCount->fetchColumn();

// Obtener los registros para la página actual
$sql = "SELECT * FROM tperosna WHERE tpNombre LIKE :search LIMIT :start, :limit";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', "%$search%");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Número total de páginas
$totalPages = ceil($totalRecords / $limit);

// Enviar los datos en formato JSON
echo json_encode([
    'totalRecords' => $totalRecords,
    'totalPages' => $totalPages,
    'data' => $results
]);
?>
