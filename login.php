<?php
$conn = new mysqli("localhost", "root", "", "dulceria_fiestita");
$conn->set_charset("utf8mb4");

$res = null;
$tipo = $_GET['tipo'] ?? '';

if ($tipo == 'usuario' && !empty($_GET['id_usr'])) {
    $res = $conn->query("SELECT * FROM login WHERE id_usr = " . intval($_GET['id_usr']));
} elseif ($tipo == 'venta' && !empty($_GET['id_venta'])) {
    $res = $conn->query("SELECT * FROM ventas WHERE id_venta = " . intval($_GET['id_venta']));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial; background: #61b8ff; padding: 20px; color: #333; }
        .box { background: white; padding: 15px; margin-bottom: 10px; border-radius: 5px; }
        input { padding: 5px; margin: 5px 0; }
        input[type="submit"] { background: #132f59; color: white; border: none; cursor: pointer; }
        .res { background: #e3f2fd; padding: 10px; border-left: 4px solid #0d47a1; }
    </style>
</head>
<body>

    <div class="box">
        <h3>Buscar Usuario</h3>
        <form method="GET">
            <input type="hidden" name="tipo" value="usuario">
            ID: <input type="number" name="id_usr" required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <div class="box">
        <h3>Buscar Venta</h3>
        <form method="GET">
            <input type="hidden" name="tipo" value="venta">
            ID: <input type="number" name="id_venta" required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if (isset($res)): ?>
        <div class="res">
            <h3>Resultado:</h3>
            <?php if ($res->num_rows > 0): $r = $res->fetch_assoc(); ?>
                <?php if ($tipo == 'usuario'): ?>
                    ID: <?= $r['id_usr']; ?><br>
                    Nombre: <?= $r['name']; ?><br>
                    Usuario: <?= $r['usr']; ?><br>
                    Pass: <?= $r['pass']; ?>
                <?php else: ?>
                    ID Venta: <?= $r['id_venta']; ?><br>
                    Cliente: <?= $r['id_cli']; ?><br>
                    Usuario: <?= $r['id_usr']; ?><br>
                    Fecha: <?= $r['fecha']; ?><br>
                    Total: <?= $r['total_v']; ?>
                <?php endif; ?>
            <?php else: ?>
                No encontrado.
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>