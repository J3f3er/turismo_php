<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Datos</title>
    <!-- Bootstrap CSS -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-4">
        <h1>Datos de Personas</h1>

        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar por nombre">
        </div>

        <div id="dataTable">
            <!-- Tabla y leyenda se insertarán aquí por jQuery -->
        </div>
    </div>

    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="../../assets/js/jquery.min.js"></script>
    <!-- Script para manejar la tabla -->
    <script>
        $(document).ready(function() {
            function loadTable(search = '', page = 1) {
                $.ajax({
                    url: 'data.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        search: search,
                        page: page,
                        limit: 10
                    },
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                            return;
                        }

                        let tableHtml = `
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Cédula</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Patología</th>
                                            <th>Observación</th>
                                            <th>Otro Teléfono</th>
                                            <th>Referencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        if (response.data.length > 0) {
                            response.data.forEach(function(row) {
                                tableHtml += `
                                    <tr>
                                        <td>${row.tpId}</td>
                                        <td>${row.tpNombre}</td>
                                        <td>${row.tpCedula}</td>
                                        <td>${row.tpNumeroTlfn}</td>
                                        <td>${row.tpCorreo}</td>
                                        <td>${row.tpPatologia}</td>
                                        <td>${row.tpObservacionM}</td>
                                        <td>${row.tpOtroTlfn}</td>
                                        <td>${row.tpReferencia}</td>
                                    </tr>
                                `;
                            });
                        } else {
                            tableHtml += `<tr><td colspan="9" class="text-center">No se encontraron resultados.</td></tr>`;
                        }

                        tableHtml += `
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p id="recordInfo"></p>
                                <nav>
                                    <ul class="pagination" id="pagination"></ul>
                                </nav>
                            </div>
                        `;

                        $('#dataTable').html(tableHtml);

                        // Actualizar la leyenda
                        const startRecord = (page - 1) * 10 + 1;
                        const endRecord = Math.min(page * 10, response.totalRecords);
                        $('#recordInfo').text(`Mostrando ${startRecord} - ${endRecord} de ${response.totalRecords} registros`);

                        // Actualizar la paginación
                        let paginationHtml = '';
                        if (page > 1) {
                            paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${page - 1}">« Anterior</a></li>`;
                        }

                        for (let i = 1; i <= response.totalPages; i++) {
                            paginationHtml += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                        }

                        if (page < response.totalPages) {
                            paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${page + 1}">Siguiente »</a></li>`;
                        }

                        $('#pagination').html(paginationHtml);
                    }
                });
            }

            // Cargar datos iniciales
            loadTable();

            // Evento de búsqueda
            $('#search').on('input', function() {
                loadTable($(this).val());
            });

            // Evento de paginación
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                loadTable($('#search').val(), page);
            });
        });
    </script>


</body>

</html>