<?php
$host = "localhost";
$user = "root";
$password = "frankpaviac3323";
$database = "dulceria_fiestita";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulcería Fiestita - Consultas</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fdf2f4; margin: 20px; color: #333; }
        h1 { color: #d63384; text-align: center; }
        h3 { text-align: center; color: #555; }
        h2 { color: #333; border-bottom: 2px solid #d63384; padding-bottom: 5px; margin-top: 40px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-bottom: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #ff477e; color: white; }
        tr:nth-child(even) { background: #fff0f3; }
    </style>
</head>
<body>

    <center>
        <h1>BIENVENIDO A CONSULTAS</h1>
        <h3>¿Qué quieres consultar?</h3>
    </center>

    <h1 style="margin-top: 30px;">🍬 Dulcería Fiestita 🍬</h1>

    <!-- Tabla 1: Productos -->
    <h2>Inventario de Productos</h2>
    <table>
        <tr>
            <th>Código de Barras</th>
            <th>Nombre</th>
            <th>Precio Venta</th>
            <th>Stock</th>
            <th>Categoría</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM Producto");
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['Codigo_barras'] . "</td>";
            echo "<td>" . $fila['Nombre_pro'] . "</td>";
            echo "<td>$" . number_format($fila['Precio_Venta'], 2) . "</td>";
            echo "<td>" . $fila['Stock'] . "</td>";
            echo "<td>" . $fila['Categoria'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Registro de Ventas</h2>
    <table>
        <tr>
            <th>ID Venta</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Productos Vendidos</th>
        </tr>
        <?php
        $resultado_ventas = $conexion->query("SELECT * FROM tb_ventas");
        while($fila = $resultado_ventas->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id_venta'] . "</td>";
            echo "<td>" . $fila['Fecha_venta'] . "</td>";
            echo "<td>$" . number_format($fila['total_v'], 2) . "</td>";
            echo "<td>" . $fila['Cantidad_productos'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conexion->close();
?>