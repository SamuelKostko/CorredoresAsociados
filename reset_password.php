<!-- filepath: c:\wamp64\www\PROYECTO\reset_password.php -->
<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token es válido y no ha expirado
    $stmt = $pdo->prepare("SELECT cedula FROM usuarios WHERE reset_token = :token AND reset_token_expiration > NOW()");
    $stmt->execute([':token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("El enlace de restablecimiento de contraseña no es válido o ha expirado.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de restablecimiento de contraseña
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($new_password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar la nueva contraseña
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos y eliminar el token
    $stmt = $pdo->prepare("UPDATE usuarios SET password = :password, reset_token = NULL, reset_token_expiration = NULL WHERE reset_token = :token");
    $stmt->execute([':password' => $hashed_password, ':token' => $token]);

    if ($stmt->rowCount() > 0) {
        echo "Tu contraseña ha sido restablecida exitosamente. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        die("Error al restablecer la contraseña. Intenta nuevamente.");
    }
} else {
    die("Acceso no autorizado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e1e2f, #3a3a5f);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        main {
            background: rgba(30, 30, 47, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 400px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background: linear-gradient(90deg, #00d4ff, #007bff);
            border: none;
            padding: 15px 30px;
            font-size: 1rem;
            color: #fff;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <main>
        <h1>Restablecer Contraseña</h1>
        <form action="reset_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Ingresa tu nueva contraseña" required>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu nueva contraseña" required>
            <button type="submit">Restablecer Contraseña</button>
        </form>
    </main>
</body>
</html>