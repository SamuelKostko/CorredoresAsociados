<!-- filepath: c:\wamp64\www\PROYECTO\db_connection.php -->
<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'proyecto';
$username = 'root'; // Cambia esto si tienes un usuario diferente
$password = ''; // Cambia esto si tienes una contraseña configurada

try {
    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar el modo de error de PDO para excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejo de errores de conexión
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>