<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Usuarios</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pagination {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Lista de Usuarios</h2>
        <div class="row">
            <div class="col-xs-12 col-lg-3">
                <div class="mb-3">
                    <input type="text" id="filter" class="form-control" placeholder="Buscar...">
                </div>
            </div>
            <div class="col-xs-12 col-lg-9">

                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Abrir Formulario
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Formulario de Ejemplo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario -->
                                <form id="exampleForm">
                                    <div class="mb-3">
                                        <label for="tpNombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="tpNombre" name="tpNombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpApellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="tpApellido" name="tpApellido" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpCedula" class="form-label">Cédula</label>
                                        <input type="text" class="form-control" id="tpCedula" name="tpCedula" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpNumeroTlfn" class="form-label">Número de Teléfono</label>
                                        <input type="text" class="form-control" id="tpNumeroTlfn" name="tpNumeroTlfn">
                                        <div id="numeroTlfnError" class="form-text text-danger"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpCorreo" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="tpCorreo" name="tpCorreo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpPatologia" class="form-label">Patología</label>
                                        <textarea class="form-control" id="tpPatologia" name="tpPatologia"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpObservacionM" class="form-label">Observaciones Médicas</label>
                                        <textarea class="form-control" id="tpObservacionM" name="tpObservacionM"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpOtroTlfn" class="form-label">Otro Teléfono</label>
                                        <input type="text" class="form-control" id="tpOtroTlfn" name="tpOtroTlfn">
                                        <div id="otroTlfnError" class="form-text text-danger"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tpReferencia" class="form-label">Referencia</label>
                                        <select class="form-control select2" id="tpReferencia" name="tpReferencia">
                                            <option value="1">Referencia 1</option>
                                            <option value="2">Referencia 2</option>
                                            <option value="3">Referencia 3</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Numero de Telefono</th>
                        <th>Patologia</th>
                        <th>Observacion Medica</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Los datos se cargarán aquí -->
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12 col-lg-6">
                <div id="info" class="mb-3"></div>
            </div>
            <div class="col-xs-12 col-lg-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination">
                        <!-- Los enlaces de paginación se cargarán aquí -->
                    </ul>
                </nav>
            </div>
        </div>



    </div>

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script>
        const limit = 10;
        let currentPage = 1;

        function fetchData(page = 1, filter = '') {
            currentPage = page;
            $.ajax({
                url: 'get_data.php',
                method: 'GET',
                data: {
                    limit: limit,
                    offset: (page - 1) * limit,
                    filter: filter
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.data);
                    // alert(response.data);
                    // Actualizar la tabla
                    let tableBody = $('#table-body');
                    tableBody.empty();
                    response.data.forEach(row => {
                        tableBody.append(`
                            <tr>
                                <td>${row.tpNombre}</td>
                                <td>${row.tpApellido}</td>
                                <td>${row.tpCedula}</td>
                                <td>${row.tpNumeroTlfn}</td>
                                <td>${row.tpPatologia}</td>
                                <td>${row.tpObservacionM}</td>
                            </tr>
                        `);
                    });

                    // Actualizar la leyenda
                    $('#info').text(`Mostrando ${response.data.length} de ${response.totalCount} registros.`);

                    // Actualizar la paginación
                    let totalPages = Math.ceil(response.totalCount / limit);
                    let pagination = $('#pagination');
                    pagination.empty();

                    for (let i = 1; i <= totalPages; i++) {
                        pagination.append(`
                            <li class="page-item ${i === page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>
                        `);
                    }
                }
            });
        }

        $(document).ready(function() {
            fetchData();

            $('#filter').on('input', function() {
                fetchData(1, $(this).val());
            });

            $('#pagination').on('click', '.page-link', function(e) {
                e.preventDefault();
                fetchData($(this).data('page'), $('#filter').val());
            });
        });

        // Script para inicializar Select2 y manejar el envío del formulario

        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2();

            // Manejar el envío del formulario
            $('#exampleForm').on('submit', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario por defecto

                // Limpiar mensajes de error
                $('#numeroTlfnError').text('');
                $('#otroTlfnError').text('');

                // Obtener valores de los campos
                var numeroTlfn = $('#tpNumeroTlfn').val().trim();
                var otroTlfn = $('#tpOtroTlfn').val().trim();

                // Validación para campos iguales
                if (numeroTlfn === otroTlfn && numeroTlfn !== '') {
                    $('#numeroTlfnError').text('Ambos números de teléfono no pueden ser iguales.');
                    $('#otroTlfnError').text('Ambos números de teléfono no pueden ser iguales.');
                    return; // Detener el envío del formulario
                }

                // Enviar datos con AJAX
                $.ajax({
                    type: 'POST',
                    url: 'your-server-endpoint.php', // Cambia esta URL por el endpoint de tu servidor
                    data: $(this).serialize(),
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        alert('Formulario enviado exitosamente.');
                        $('#exampleModal').modal('hide'); // Cerrar el modal
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores
                        alert('Error al enviar el formulario: ' + error);
                    }
                });
            });
        });

        // Manejar el envío del formulario
        $('#exampleForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'registerPersona.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // Mostrar errores
                        for (let key in response.errors) {
                            $('#' + key + 'Error').text(response.errors[key]);
                        }
                    } else {
                        // Limpiar errores
                        $('.form-text.text-danger').text('');

                        if (response.success) {
                            // Actualizar la tabla y restablecer el formulario
                            fetchData();
                            $('#exampleForm')[0].reset();
                            $('#exampleModal').modal('hide');
                        } else {
                            alert(response.error);
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>