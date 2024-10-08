<?php
session_start();

if (!isset($_SESSION['tId'])) {
    header('Location: login.php'); // Redirige si el usuario no está logueado
    exit();
}

require '../conexion/conexion.php';

// Obtener información del usuario
$stmt = $pdo->prepare('SELECT * FROM tusuarios WHERE tId = :tId');
$stmt->execute(['tId' => $_SESSION['tId']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="usuarios-link">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="personas-link">Personas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Bienvenid@, <?php echo htmlspecialchars($user['tNombre']); ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
    <div id="contenido" class="mt-3">
            <!-- Aquí se cargará la vista de usuarios -->
        </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/dataTables/js/datatables.js"></script>
    <script src="../../assets/js/dataTables/js/vfs_fonts.js"></script>
    <script src="../../assets/js/dataTables/js/pdfmake.js"></script>
    <script>
        $(document).ready(function() {
             // Manejar clic en Usuarios
             $('#usuarios-link').click(function(e) {
                e.preventDefault();
                $('#contenido').load('usuarios.php'); // Carga la tabla de usuarios
            });

            // Manejar clic en Personas
            $('#personas-link').click(function(e) {
                e.preventDefault();
                $('#contenido').load('personas.php'); // Carga la vista de personas
            });
        });
    </script>
</body>

</html>