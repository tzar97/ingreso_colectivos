<?php
// Configuración de los headers para permitir CORS y recibir datos JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Mostrar todos los errores de PHP para depuración
error_reporting(E_ALL);

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";  // Usuario de tu base de datos
$password = "123";   // Contraseña de tu base de datos
$dbname = "colectivos_terminal_posadas";  // Nombre de la base de datos que quieres usar

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);  // Mostrar el error de conexión
}

// Leer los datos JSON enviados desde el formulario
$input = file_get_contents("php://input");
$datos = json_decode($input, true);

// Verificar si los datos se recibieron correctamente
if ($datos === null) {
    die("Error: No se recibieron datos válidos");
}

// Extraer los datos del array asociativo
$nombre_inspector = $conn->real_escape_string($datos['nombre']);
$apellido_inspector = $conn->real_escape_string($datos['apellido']);
$fecha = $conn->real_escape_string($datos['fecha']);
$turno = $conn->real_escape_string($datos['turno']);
$periodo = $conn->real_escape_string($datos['periodo']);
$anden = $conn->real_escape_string($datos['anden']);
$arrSal = $conn->real_escape_string($datos['arrSal']);
$empresa = $conn->real_escape_string($datos['empresa']);
$servicio = $conn->real_escape_string($datos['servicio']);
$cocheNumero = $conn->real_escape_string($datos['cocheNumero']);
$ticketNumero = $conn->real_escape_string($datos['ticketNumero']);
$horaIngreso = $conn->real_escape_string($datos['horaIngreso']);
$importeCanon = $conn->real_escape_string($datos['importeCanon']);
$procedencia = $conn->real_escape_string($datos['procedencia']);
$destino = $conn->real_escape_string($datos['destino']);

// Preparar la consulta SQL para insertar los datos
$sql = "INSERT INTO ingreso_colectivos 
        (nombre_inspector, apellido_inspector, fecha, turno, periodo, anden, arrSal, empresa, servicio, cocheNumero, ticketNumero, horaIngreso, importeCanon, procedencia, destino)
        VALUES 
        ('$nombre_inspector', '$apellido_inspector', '$fecha', '$turno', '$periodo', '$anden', '$arrSal', '$empresa', '$servicio', '$cocheNumero', '$ticketNumero', '$horaIngreso', '$importeCanon', '$procedencia', '$destino')";

// Mostrar la consulta SQL para depuración
echo $sql . "<br>";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
