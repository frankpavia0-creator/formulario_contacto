<?php
require_once 'conexion.php';

$res = null;
$tipo = $_GET['tipo'] ?? '';

if ($tipo === 'usuario' && !empty($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']);
    $stmt = $conn->prepare("SELECT id_usuario, Nombre_Completo, Usuario, Rol FROM Login WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $res = $stmt->get_result();
} elseif ($tipo === 'venta' && !empty($_GET['id_venta'])) {
    $id_venta = intval($_GET['id_venta']);
    $stmt = $conn->prepare("SELECT id_venta, id_cliente, id_usuario, Fecha_venta, total_v FROM tb_ventas WHERE id_venta = ?");
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $res = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta - Dulcería Fiestita</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e3f2fd; padding: 20px; color: #333; }
        .box { background: white; padding: 15px; margin-bottom: 15px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input { padding: 8px; margin: 5px 0; }
        input[type="submit"] { background: #0d47a1; color: white; border: none; cursor: pointer; border-radius: 3px; }
        .res { background: white; padding: 15px; border-left: 4px solid #0d47a1; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="box">
        <h3>Buscar Usuario</h3>
        <form method="GET">
            <input type="hidden" name="tipo" value="usuario">
            ID Usuario: <input type="number" name="id_usuario" required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <div class="box">
        <h3>Buscar Venta</h3>
        <form method="GET">
            <input type="hidden" name="tipo" value="venta">
            ID Venta: <input type="number" name="id_venta" required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if ($res !== null): ?>
        <div class="res">
            <h3>Resultado:</h3>
            <?php if ($res->num_rows > 0): $r = $res->fetch_assoc(); ?>
                <?php if ($tipo === 'usuario'): ?>
                    <strong>ID:</strong> <?= htmlspecialchars($r['id_usuario']); ?><br>
                    <strong>Nombre:</strong> <?= htmlspecialchars($r['Nombre_Completo']); ?><br>
                    <strong>Usuario:</strong> <?= htmlspecialchars($r['Usuario']); ?><br>
                    <strong>Rol:</strong> <?= htmlspecialchars($r['Rol']); ?>
                <?php else: ?>
                    <strong>ID Venta:</strong> <?= htmlspecialchars($r['id_venta']); ?><br>
                    <strong>ID Cliente:</strong> <?= htmlspecialchars($r['id_cliente'] ?? 'N/A'); ?><br>
                    <strong>ID Usuario:</strong> <?= htmlspecialchars($r['id_usuario']); ?><br>
                    <strong>Fecha:</strong> <?= htmlspecialchars($r['Fecha_venta']); ?><br>
                    <strong>Total:</strong> $<?= number_format($r['total_v'], 2); ?>
                <?php endif; ?>
            <?php else: ?>
                <p>No se encontraron registros.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>
<?php
$conn->close();
?>