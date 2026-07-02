<?php
include '../../config/database.php';

$tipo = (string) ($_GET['tipo'] ?? '');

$reportes = [
    'instituciones' => [
        'filename' => 'instituciones.csv',
        'headers' => ['ID', 'Nombre', 'RUC', 'Direccion', 'Telefono', 'Correo', 'Representante', 'FechaRegistro'],
        'sql' => 'SELECT id_institucion, nombre, ruc, direccion, telefono, email, representante, fecha_registro FROM instituciones ORDER BY id_institucion DESC',
    ],
    'eventos' => [
        'filename' => 'eventos.csv',
        'headers' => ['ID', 'Nombre', 'Descripcion', 'FechaInicio', 'FechaFin', 'Estado'],
        'sql' => 'SELECT id_evento, nombre, descripcion, fecha_inicio, fecha_fin, estado FROM eventos ORDER BY id_evento DESC',
    ],
    'arbitros' => [
        'filename' => 'arbitros.csv',
        'headers' => ['ID', 'Nombres', 'Apellidos', 'Telefono', 'Experiencia'],
        'sql' => 'SELECT id_arbitro, nombres, apellidos, telefono, experiencia FROM arbitros ORDER BY id_arbitro DESC',
    ],
    'equipos' => [
        'filename' => 'equipos.csv',
        'headers' => ['ID', 'Equipo', 'Institucion', 'Deporte', 'Categoria', 'Capitan', 'TelefonoCapitan'],
        'sql' => 'SELECT e.id_equipo, e.nombre, i.nombre AS institucion, d.nombre AS deporte, c.nombre AS categoria, e.capitan, e.telefono_capitan FROM equipos e INNER JOIN instituciones i ON e.id_institucion=i.id_institucion INNER JOIN deportes d ON e.id_deporte=d.id_deporte INNER JOIN categorias c ON e.id_categoria=c.id_categoria ORDER BY e.id_equipo DESC',
    ],
    'jugadores' => [
        'filename' => 'jugadores.csv',
        'headers' => ['ID', 'Equipo', 'Nombres', 'Apellidos', 'DNI', 'Edad', 'Genero', 'Camiseta', 'Posicion'],
        'sql' => 'SELECT j.id_jugador, e.nombre AS equipo, j.nombres, j.apellidos, j.dni, j.edad, j.genero, j.numero_camiseta, j.posicion FROM jugadores j INNER JOIN equipos e ON j.id_equipo=e.id_equipo ORDER BY j.id_jugador DESC',
    ],
    'partidos' => [
        'filename' => 'partidos.csv',
        'headers' => ['ID', 'Evento', 'Deporte', 'Arbitro', 'Local', 'Visitante', 'Fecha', 'Lugar', 'Estado'],
        'sql' => 'SELECT p.id_partido, ev.nombre AS evento, d.nombre AS deporte, CONCAT(COALESCE(a.nombres, \'\'), \' \', COALESCE(a.apellidos, \'\')) AS arbitro, l.nombre AS local, v.nombre AS visitante, p.fecha, p.lugar, p.estado FROM partidos p INNER JOIN eventos ev ON p.id_evento=ev.id_evento INNER JOIN deportes d ON p.id_deporte=d.id_deporte INNER JOIN equipos l ON p.equipo_local=l.id_equipo INNER JOIN equipos v ON p.equipo_visitante=v.id_equipo LEFT JOIN arbitros a ON p.id_arbitro=a.id_arbitro ORDER BY p.id_partido DESC',
    ],
    'resultados' => [
        'filename' => 'resultados.csv',
        'headers' => ['ID', 'Partido', 'MarcadorLocal', 'MarcadorVisitante', 'Ganador', 'Observaciones'],
        'sql' => 'SELECT r.id_resultado, CONCAT(l.nombre, \' vs \', v.nombre) AS partido, r.marcador_local, r.marcador_visitante, r.ganador, r.observaciones FROM resultados r INNER JOIN partidos p ON r.id_partido=p.id_partido INNER JOIN equipos l ON p.equipo_local=l.id_equipo INNER JOIN equipos v ON p.equipo_visitante=v.id_equipo ORDER BY r.id_resultado DESC',
    ],
    'notificaciones' => [
        'filename' => 'notificaciones.csv',
        'headers' => ['ID', 'Titulo', 'Mensaje', 'Fecha'],
        'sql' => 'SELECT id_notificacion, titulo, mensaje, fecha FROM notificaciones ORDER BY id_notificacion DESC',
    ],
];

if (!isset($reportes[$tipo])) {
    header('Location: index.php');
    return;
}

$config = $reportes[$tipo];
$rows = $conexion->query($config['sql'])->fetchAll(PDO::FETCH_NUM);

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=' . $config['filename']);

$output = fopen('php://output', 'wb');
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
fputcsv($output, $config['headers']);
foreach ($rows as $row) {
    fputcsv($output, $row);
}
fclose($output);
return;
?>
