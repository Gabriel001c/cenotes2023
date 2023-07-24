<!DOCTYPE html>
<html>
<head>
<link href="css/adm2.css" rel="stylesheet" />

    <title>Eventos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
            height: 100px;
        }
        .titulo {
            max-height: 2em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
        .descripcion {
            max-height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Eventos</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Ubicación</th>
                <th>Foto</th>
                <th>IDEstatus</th>
                <th>Comentario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventos as $evento): ?>
                <tr>
                    <td>
                        <div class="titulo"><?php echo $evento['Titulo']; ?></div>
                    </td>
                    <td>
                        <div class="descripcion"><?php echo $evento['Descripcion']; ?></div>
                    </td>
                    <td><?php echo $evento['Fecha']; ?></td>
                    <td><?php echo $evento['Hora']; ?></td>
                    <td><?php echo $evento['Ubicacion']; ?></td>
                    <td>
                        <img src="<?php echo $evento['Fotos']; ?>" alt="Foto">
                    </td>
                    <td><?php echo $evento['IDEstatus']; ?></td>
                    <td><?php echo $evento['Comentario']; ?></td>
                    <td>
                        <a href="#" onclick="abrirModal(<?php echo $evento['IDEventos']; ?>, '<?php echo $evento['Ubicacion']; ?>')">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <iframe id="editarEventoFrame" src="" style="width: 100%; height: 100%; border: none;"></iframe>
        </div>
    </div>

    <script>
        function abrirModal(idEvento, ubicacion) {
            var modal = document.getElementById('modal');
            var iframe = document.getElementById('editarEventoFrame');
            iframe.src = "model/editar_evento.php?IDEventos=" + idEvento + "&ubicacion=" + encodeURIComponent(ubicacion);
            modal.style.display = 'block';
        }

        function cerrarModal() {
            var modal = document.getElementById('modal');
            var iframe = document.getElementById('editarEventoFrame');
            iframe.src = "";
            modal.style.display = 'none';
        }
    </script>
</body>
</html>
