<?php
session_start(); // Inicia la sesión

require '../conexion/conexion.php'; // Archivo con la conexión a la base de datos

// Función para recordar al usuario por 30 días
function setRememberMeCookie($userId) {
    $cookieValue = base64_encode($userId); // Codificamos el ID del usuario para almacenarlo en la cookie
    setcookie('remember_user', $cookieValue, time() + (30 * 24 * 60 * 60), "/"); // Cookie por 30 días
}

// Función para eliminar la cookie
function deleteRememberMeCookie() {
    setcookie('remember_user', '', time() - 3600, "/"); // Expira la cookie
}

// Verifica si hay una cookie activa para recordar al usuario
if (isset($_COOKIE['remember_user'])) {
    $_SESSION['tId'] = base64_decode($_COOKIE['remember_user']);
    header('Location: dashboard.php');
    exit();
}

// Si ya está autenticado, redirigir
if (isset($_SESSION['tId'])) {
    header('Location: dashboard.php');
    exit();
}

// Procesa el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['tUsuario'];
    $password = $_POST['tClv'];
    $rememberMe = isset($_POST['remember']); // Check para "Recordarme"

    // Consulta para obtener los datos del usuario
    $stmt = $pdo->prepare('SELECT * FROM tusuarios WHERE tUsuario = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['tClv'])) {
        $_SESSION['tId'] = $user['tId']; // Guarda en sesión el ID del usuario

        // Si seleccionó "Recordarme", se guarda en una cookie
        if ($rememberMe) {
            setRememberMeCookie($user['tId']);
        }

        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Credenciales incorrectas.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 10px;
            border-color: #6c63ff;
        }

        .btn-primary {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }

        .btn-primary:hover {
            background-color: #5a54cc;
            border-color: #5a54cc;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="tUsuario" class="form-label">Usuario</label>
                    <input type="text" id="tUsuario" name="tUsuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tClv" class="form-label">Contraseña</label>
                    <input type="password" id="tClv" name="tClv" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Recordarme</label>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
