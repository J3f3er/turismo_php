<?php
header('Content-Type: application/json');
$dsn = 'mysql:host=localhost;dbname=turismo';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tNombre = $_POST['tNombre'];
    $tApellido = $_POST['tApellido'];
    $tUsuario = $_POST['tUsuario'];
    $tUsuario_password = $_POST['tUsuario_password'];
    $tEmail = $_POST['tEmail'];

    if (empty($tUsuario) || empty($tUsuario_password)) {
        echo json_encode(['error' => 'Usuario y contraseña son requeridos']);
        exit;
    }

    // Encriptar contraseña
    $hashedPassword = password_hash($tUsuario_password, PASSWORD_BCRYPT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO tusuarios (tNombre, tApellido, tUsuario, tUsuario_password, tEmail, creado_at) 
            VALUES (:tNombre, :tApellido, :tUsuario, :tUsuario_password, :tEmail, NOW())";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':tNombre' => $tNombre,
            ':tApellido' => $tApellido,
            ':tUsuario' => $tUsuario,
            ':tUsuario_password' => $hashedPassword,
            ':tEmail' => $tEmail
        ]);
        echo json_encode(['success' => 'Registro exitoso']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al registrar: ' . $e->getMessage()]);
    }
}
?>
