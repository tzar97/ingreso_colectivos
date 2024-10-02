<?php
// obtener_datos.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "colectivos_terminal_posadas"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener todos los datos de la tabla ingreso_colectivos
$sql = "SELECT 
            nombre_inspector AS 'Nombre inspector', 
            apellido_inspector AS 'Apellido inspector', 
            fecha AS 'Fecha', 
            turno AS 'Turno', 
            periodo AS 'Periodo', 
            anden AS 'Anden', 
            arrSal AS 'Arribo / Salida', 
            empresa AS 'Empresa', 
            servicio AS 'Servicio', 
            cocheNumero AS 'Nº Coche', 
            ticketNumero AS 'Nº Ticket', 
            horaIngreso AS 'Hora de ingreso', 
            importeCanon AS 'Importe Canon', 
            procedencia AS 'Procedencia', 
            destino AS 'Destino', 
            fecha_registro AS 'Fecha de registro' 
        FROM ingreso_colectivos";

$result = $conn->query($sql);

$datos = [];

if ($result->num_rows > 0) {
    // Obtener los datos
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($datos);

// Cerrar conexión
$conn->close();
?>
