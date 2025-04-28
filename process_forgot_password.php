<!-- filepath: c:\wamp64\www\PROYECTO\process_forgot_password.php -->
<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';
require 'vendor/autoload.php'; // Asegúrate de que PHPMailer esté instalado con Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = trim($_POST['cedula']);
    $contact = trim($_POST['contact']);

    // Validar que los campos no estén vacíos
    if (empty($cedula) || empty($contact)) {
        header("Location: forgot_password.php?error=Por favor completa todos los campos.");
        exit;
    }

    try {
        // Verificar si la cédula existe y si el contacto coincide
        $stmt = $pdo->prepare("SELECT email, telefono FROM usuarios WHERE cedula = :cedula");
        $stmt->execute([':cedula' => $cedula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar si el contacto coincide con el correo o el teléfono registrado
            if ($contact === $user['email'] || $contact === $user['telefono']) {
                // Generar un token único para la recuperación de contraseña
                $token = bin2hex(random_bytes(16));
                $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = :token, reset_token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE cedula = :cedula");
                $stmt->execute([':token' => $token, ':cedula' => $cedula]);

                // Configurar PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'noreply.datahouse@gmail.com'; // Cambia esto por tu correo
                    $mail->Password = 'gfhx xlvs pbjp uadk'; // Cambia esto por tu contraseña
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // Puerto SMTP (puede variar)

                    // Configuración del correo
                    $mail->setFrom('no-reply@asc.com', 'Corredores Asociados');
                    $mail->addAddress($user['email']); // Correo del destinatario

                    // Contenido del correo
                    $resetLink = "http://localhost/PROYECTO/reset_password.php?token=$token";
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperación de contraseña - Corredores Asociados';
                    $mail->Body = "
                        <p>Hola,</p>
                        <p>Hemos recibido una solicitud para restablecer tu contraseña. Si realizaste esta solicitud, haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                        <p><a href='$resetLink' style='color: #007bff; text-decoration: none;'>Restablecer contraseña</a></p>
                        <p>Este enlace es válido por <strong>1 hora</strong>.</p>
                        <p>Si no realizaste esta solicitud, puedes ignorar este mensaje. Tu contraseña actual seguirá siendo segura.</p>
                        <p>Atentamente,<br>El equipo de Corredores Asociados</p>
                    ";

                    // Enviar el correo
                    $mail->send();
                    header("Location: forgot_password.php?success=Se ha enviado un enlace de recuperación a tu correo.");
                } catch (Exception $e) {
                    header("Location: forgot_password.php?error=No se pudo enviar el correo. Error: {$mail->ErrorInfo}");
                }
                exit;
            } else {
                header("Location: forgot_password.php?error=El correo o teléfono no coincide con el registrado.");
                exit;
            }
        } else {
            header("Location: forgot_password.php?error=La cédula no está registrada.");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: forgot_password.php?error=Error en el servidor: " . $e->getMessage());
        exit;
    }
} else {
    header("Location: forgot_password.php");
    exit;
}
?>