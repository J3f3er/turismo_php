<?php
session_start();

require '../conexion/conexion.php';

$stmt = $pdo->prepare('SELECT * FROM tusuarios');
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="table-responsive">
    <table id="usuarios" class="table table-striped table-bordered" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Email</th>
                <!-- <th>Creado</th>
                <th>Actualizado</th> -->
                <th>Avatar</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#usuarios').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            ajax: {
                url: '../../PHP/obtener-usuarios.php', // Cambia esto por la ruta correcta de tu API
                dataSrc: 'data'
            },
            columns: [{
                    data: 'tId',
                    name: 'iId'
                },
                {
                    data: 'tNombre',
                    name: 'tNombre'
                },
                {
                    data: 'tApellido',
                    name: 'tApellido'
                },
                {
                    data: 'tUsuario',
                    name: 'tUsuario'
                },
                {
                    data: 'tEmail',
                    name: 'tEmail'
                },
                /* {
                    data: 'creado_at',
                    name: 'creado_at'
                },
                {
                    data: 'update_at',
                    name: 'update_at'
                }, */
                {
                    data: 'tAvatar',
                    name: 'tAvatar',
                    render: function(data, type, row) {
                        return `<img src="${data}" alt="Avatar" style="width: 50px; height: 50px;">`;
                    }
                }
            ],
            colReorder: true,
            fixedColumns: true,
            fixedHeader: true,
            keyTable: true,
            searchPanes: true,
            scroller: true,
            stateSave: true,
            autoFill: true,
            rowReorder: true,
            columnDefs: [{
                    targets: [0, 1, 2],
                    visible: true
                },
                {
                    targets: '_all',
                    visible: true
                }
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();
                var total = api.column(5).data().reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0);
                $(api.column(5).footer()).html('$' + total);
            },
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ entradas",
                "sZeroRecords": "No se encontraron resultados",
                "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ entradas",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "sInfoFiltered": "(filtrado de _MAX_ entradas totales)",
                "sSearch": "",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "csv": "CSV",
                    "excel": "Excel",
                    "print": "Imprimir",
                    "colvis": "Visibilidad de columnas"
                }
            }
        });

        $('#dt-search-0').removeClass('form-control-sm')
        $('#dt-search-0').addClass('mb-4')

        $('.buttons-copy').addClass('btn-primary')
        $('.buttons-excel').addClass('btn-success')
        $('.buttons-csv').addClass('btn-warning')
        $('.buttons-print').addClass('btn-dark')
        
        $('.buttons-copy').removeClass('btn-secondary')
        $('.buttons-excel').removeClass('btn-secondary')
        $('.buttons-csv').removeClass('btn-secondary')
        $('.buttons-print').removeClass('btn-secondary')

    });
</script>
