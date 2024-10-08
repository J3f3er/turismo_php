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

// Obtener los datos del formulario
$tpNombre = $_POST['tpNombre'] ?? '';
$tpApellido = $_POST['tpApellido'] ?? '';
$tpCedula = $_POST['tpCedula'] ?? '';
$tpNumeroTlfn = $_POST['tpNumeroTlfn'] ?? '';
$tpCorreo = $_POST['tpCorreo'] ?? '';
$tpPatologia = $_POST['tpPatologia'] ?? '';
$tpObservacionM = $_POST['tpObservacionM'] ?? '';
$tpOtroTlfn = $_POST['tpOtroTlfn'] ?? '';
$tpReferencia = $_POST['tpReferencia'] ?? '';

// Validar y sanitizar los datos
$errors = [];

if (empty($tpNombre)) $errors['tpNombre'] = 'Nombre es requerido.';
if (empty($tpApellido)) $errors['tpApellido'] = 'Apellido es requerido.';
if (empty($tpCedula)) $errors['tpCedula'] = 'Cédula es requerida.';

// Si hay errores, devolverlos
if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit;
}

// Insertar datos en la base de datos
$sql = "INSERT INTO tperosna (tpNombre, tpApellido, tpCedula, tpNumeroTlfn, tpCorreo, tpPatologia, tpObservacionM, tpOtroTlfn, tpReferencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$tpNombre, $tpApellido, $tpCedula, $tpNumeroTlfn, $tpCorreo, $tpPatologia, $tpObservacionM, $tpOtroTlfn, $tpReferencia]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => "Error al registrar: " . $e->getMessage()]);
}
?>
