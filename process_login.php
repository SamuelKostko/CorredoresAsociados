<!-- filepath: c:\wamp64\www\PROYECTO\process_login.php -->
<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = trim($_POST['cedula']);
    $password = trim($_POST['password']);

    // Validación básica
    if (empty($cedula) || empty($password)) {
        header("Location: login.php?error=" . urlencode("Todos los campos son obligatorios."));
        exit;
    }

    try {
        // Buscar al usuario en la base de datos por cédula
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
        $stmt->execute([':cedula' => $cedula]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Iniciar sesión (puedes usar sesiones aquí)
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre_apellido'] = $usuario['nombre_apellido'];
                $_SESSION['cedula'] = $usuario['cedula'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                // Redirigir al área protegida o página principal
                header("Location: dashboard.php");
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: login.php?error=" . urlencode("Contraseña incorrecta."));
                exit;
            }
        } else {
            // Usuario no encontrado
            header("Location: login.php?error=" . urlencode("La cédula no está registrada."));
            exit;
        }
    } catch (PDOException $e) {
        // Manejo de errores de base de datos
        header("Location: login.php?error=" . urlencode("Error al procesar la solicitud."));
        exit;
    }
}
?>