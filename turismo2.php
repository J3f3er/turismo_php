<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo Aventura</title>
    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/WhatsApp Image 2024-08-12 at 6.18.33 PM.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/js/dataTables/css/datatables.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            text-align: center;
            padding-top: 50px;
        }

        .logo-container {
            max-width: 300px;
            margin: 0 auto;
        }

        .logo-container img {
            width: 100%;
            height: auto;
        }

        .title {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #212529;
        }

        .navbar-brand img {
            height: 40px;
            /* Ajusta la altura de la imagen al tamaño del navbar */
            width: auto;
            /* Mantiene la proporción de la imagen */
        }

        .navbar {
            padding-top: 5px;
            /* Reduce el espacio en la parte superior */
            padding-bottom: 5px;
            /* Reduce el espacio en la parte inferior */
            height: auto;
            /* Ajusta la altura automáticamente al contenido */
            line-height: normal;
            /* Ajusta la altura de la línea */
        }

        .navbar-brand,
        .navbar-nav>li>a {
            padding-top: 0;
            /* Reduce el padding interno en la parte superior */
            padding-bottom: 0;
            /* Reduce el padding interno en la parte inferior */
            line-height: normal;
            /* Asegura que el texto esté alineado correctamente */
        }


        .carousel-inner {
            max-width: 100%;
            height: 400px;
            /* Ajusta la altura según tus necesidades */
            position: relative;
            /* Esto es importante para el posicionamiento de las imágenes */
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Mantiene la proporción y cubre el área del contenedor */
        }

        @media (max-width: 768px) {
            .carousel-inner {
                height: 300px;
                /* Ajusta la altura para pantallas más pequeñas */
            }
        }

        @media (max-width: 576px) {
            .carousel-inner {
                height: 200px;
                /* Ajusta la altura para pantallas aún más pequeñas */
            }
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            Sistema de Comunicaciones y Operaciones Aragua &nbsp;
            <a class="navbar-brand" href="#">
                <img src="img/WhatsApp Image 2024-08-12 at 6.18.33 PM.jpeg" alt="Logo Turismo Aventura">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Misión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Visión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Verificate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<div class="container mt-5">
    <h1 class="mb-4">DataTables Example</h1>

    <!-- Table -->
     <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Avatar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí agregarás dinámicamente las filas con datos de la tabla 'tusuarios' -->
            </tbody>
    </table>
     </div>
</div>

    <div class="container">
        <div class="row">
            <div class="logo-container">
                <img src="img/WhatsApp Image 2024-08-12 at 6.18.33 PM.jpeg" alt="SCOA Logo">
            </div>
            <div class="title">
                Sistema de Comunicaciones y Operaciones Aragua
            </div>
            <div class="subtitle">
                Venezuela
            </div>
        </div>
    </div>
    <header class="bg-primary text-white text-center py-3">
        <h1>Explora el Mundo</h1>
        <p>Descubre los mejores destinos turísticos</p>
    </header>

    <div id="turismoCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#turismoCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#turismoCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#turismoCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/983b442c-b7ac-4c26-87b2-9b085f14af0e.jpg" class="d-block w-100" alt="Playas Paradisíacas">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Playas Paradisíacas</h5>
                    <p>Relájate en las mejores playas del mundo.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/DALL·E 2024-08-17 01.35.54 - A breathtaking mountain landscape with towering peaks, covered in snow, reaching up to the sky. The mountain is surrounded by lush green forests at it.webp" class="d-block w-100" alt="Montañas Impresionantes">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Montañas Impresionantes</h5>
                    <p>Escala las montañas más majestuosas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x500?text=Ciudades+Históricas" class="d-block w-100" alt="Ciudades Históricas">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ciudades Históricas</h5>
                    <p>Visita las ciudades más antiguas y llenas de historia.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#turismoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#turismoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> Turismo Aventura. Todos los derechos reservados.</p>
    </footer>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/dataTables/js/datatables.js"></script>
        <script src="assets/js/dataTables/js/vfs_fonts.js"></script>
        <script src="assets/js/dataTables/js/pdfmake.js"></script>        
      <script src="assets/js/dataTables/turismo.js"></script>
</body>
</html>

