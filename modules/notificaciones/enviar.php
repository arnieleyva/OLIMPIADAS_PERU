<?php
include '../../config/database.php';

$idPartido = (int) ($_GET['id_partido'] ?? 0);
$destino = (string) ($_GET['destino'] ?? 'local');

$stmt = $conexion->prepare('
    SELECT
        p.fecha,
        p.lugar,
        local.nombre AS local,
        local.capitan AS capitan_local,
        local.telefono_capitan AS telefono_local,
        visitante.nombre AS visitante,
        visitante.capitan AS capitan_visitante,
        visitante.telefono_capitan AS telefono_visitante
    FROM partidos p
    INNER JOIN equipos local ON p.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON p.equipo_visitante = visitante.id_equipo
    WHERE p.id_partido = ?
');
$stmt->execute([$idPartido]);
$partido = $stmt->fetch();

if (!$partido) {
    header('Location: ' . app_url('modules/programacion/index.php'));
    return;
}

$esLocal = $destino === 'local';
$equipoDestino = $esLocal ? $partido['local'] : $partido['visitante'];
$equipoRival = $esLocal ? $partido['visitante'] : $partido['local'];
$capitan = $esLocal ? $partido['capitan_local'] : $partido['capitan_visitante'];
$telefono = $esLocal ? $partido['telefono_local'] : $partido['telefono_visitante'];

if (!$telefono) {
    header('Location: ' . app_url('modules/programacion/index.php'));
    return;
}

$mensaje = 'Hola ' . ($capitan ?: 'capitan') . ', el equipo ' . $equipoDestino . ' tiene un partido programado contra ' . $equipoRival . ' el ' . $partido['fecha'] . ' en ' . $partido['lugar'] . '.';

$stmt = $conexion->prepare('INSERT INTO notificaciones (titulo, mensaje) VALUES (?, ?)');
$stmt->execute([
    'Aviso de partido para ' . $equipoDestino,
    $mensaje,
]);

$url = 'https://wa.me/51' . preg_replace('/\D+/', '', (string) $telefono) . '?text=' . rawurlencode($mensaje);
header('Location: ' . $url);
return;
?>
