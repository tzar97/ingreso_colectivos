<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "colectivos_terminal_posadas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode([
        'error' => true,
        'message' => "Conexión fallida: " . $conn->connect_error
    ]));
}

// Obtener los datos enviados desde el frontend como JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

var_dump($data);

$empresa = $data['empresa'];
$procedencia = $data['procedencia'];
$destino = $data['destino'];
$servicio = $data['servicio'];

// Consulta para obtener el precio
$sql = "SELECT precio FROM tarifa WHERE empresa = ? AND procedencia = ? AND destino = ? AND servicio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $empresa, $procedencia, $destino, $servicio);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row['precio']);
} else {
    echo json_encode("No se encontró un precio para esta combinación.");
}

$conn->close();
?>
