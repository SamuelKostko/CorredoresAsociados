<!-- filepath: c:\wamp64\www\PROYECTO\process_register.php -->
<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_apellido = trim($_POST['nombre_apellido']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $codigo_operadora = trim($_POST['codigo_operadora']);
    $telefono = trim($_POST['telefono']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validación básica
    $errors = [];

    if (empty($nombre_apellido)) {
        $errors[] = "El nombre y apellido son obligatorios.";
    }

    if (empty($cedula)) {
        $errors[] = "La cédula es obligatoria.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido.";
    }

    if (empty($telefono) || !preg_match('/^[0-9]{7}$/', $telefono)) {
        $errors[] = "El número de teléfono debe tener exactamente 7 dígitos.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    // Si hay errores, redirigir a register.php con los mensajes de error
    if (!empty($errors)) {
        $error_message = urlencode(implode(', ', $errors));
        header("Location: register.php?error=$error_message");
        exit;
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Guardar los datos en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_apellido, cedula, email, telefono, password, tipo_usuario) VALUES (:nombre_apellido, :cedula, :email, :telefono, :password, :tipo_usuario)");
        $stmt->execute([
            ':nombre_apellido' => $nombre_apellido,
            ':cedula' => $cedula,
            ':email' => $email,
            ':telefono' => $codigo_operadora . $telefono,
            ':password' => $hashed_password,
            ':tipo_usuario' => 'cliente', // Siempre será cliente desde el formulario
        ]);

        // Redirigir al inicio de sesión después del registro exitoso
        header("Location: login.php?success=1");
        exit;
    } catch (PDOException $e) {
        // Manejo de errores al guardar en la base de datos
        if ($e->getCode() === '23000') { // Código de error para duplicados
            $error_message = urlencode("La cédula o el correo ya están registrados.");
            header("Location: register.php?error=$error_message");
        } else {
            $error_message = urlencode("Error al registrar el usuario: " . $e->getMessage());
            header("Location: register.php?error=$error_message");
        }
        exit;
    }
}
?>