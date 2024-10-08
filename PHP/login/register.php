<?php
// Asegúrate de que se proporciona el número correcto de argumentos
if ($argc !== 6) {
    echo "Uso: php register.php <username> <password> <nombre> <apellido> <email>\n";
    exit(1);
}

// Recoge los argumentos desde la línea de comandos
$username = $argv[1];
$password = $argv[2];
$nombre = $argv[3];
$apellido = $argv[4];
$email = $argv[5];

// Configuración de la base de datos
$host = 'localhost';
$db = 'turismo';
$user = 'root';
$pass = '';

try {
    // Crea una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Genera un hash de la contraseña usando bcrypt
    /* $hashedPassword = md5($password); */
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepara la consulta SQL para insertar el nuevo usuario
    $sql = 'INSERT INTO tusuarios (tNombre, tApellido, tUsuario, tEmail, tClv) VALUES (:tNombre, :tApellido, :tUsuario, :tEmail, :tClv)';
    $stmt = $pdo->prepare($sql);

    // Ejecuta la consulta
    $stmt->execute([
        ':tNombre' => $nombre,
        ':tApellido' => $apellido,
        ':tUsuario' => $username,
        ':tEmail' => $email,
        ':tClv' => $hashedPassword
    ]);

    echo "Registro exitoso.\n";
} catch (PDOException $e) {
    echo "Error de conexión o ejecución: " . $e->getMessage() . "\n";
}
?>
