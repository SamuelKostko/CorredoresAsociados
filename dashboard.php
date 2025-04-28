<!-- filepath: c:\wamp64\www\PROYECTO\dashboard.php -->
<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=" . urlencode("Debes iniciar sesión para acceder al dashboard."));
    exit;
}

// Obtener los datos del usuario desde la sesión
$cedula = htmlspecialchars($_SESSION['cedula']);
$email = htmlspecialchars($_SESSION['email']);
$tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: #1e1e2f;
            color: #fff;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .content {
            padding: 0px;
            flex: 1;
        }

        header {
            background: #2c2c3e;
            padding: 30px 20px; /* Elimina los márgenes laterales */
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; /* Asegura que ocupe todo el ancho */
            box-sizing: border-box; /* Incluye el padding en el ancho total */
        }

        .header-left {
            font-size: 1.5rem; /* Slightly larger font size */
            font-weight: bold; /* Make the text bold */
            text-transform: uppercase; /* Optional: Make it look more like a subtitle */
        }

        .info-menu {
            position: relative;
            display: inline-block;
            margin-right: 20px;
        }

        .info-menu button {
            background: #00d4ff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .info-menu-content {
            display: none;
            position: absolute;
            top: 100%; 
            right: 0; 
            transform: translateX(-10px); 
            background: #2c2c3e;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 200px; /* Ajusta el ancho según sea necesario */
        }

        .info-menu:hover .info-menu-content {
            display: block;
        }

        .logout-logo {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .banner {
            background: #3a3a5f;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .banner img {
            max-width: 100%;
            border-radius: 10px;
        }

        .info-box {
            background: #2c2c3e;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: #2c2c3e;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative; /* Ensure the close button is positioned relative to the popup content */
        }

        .close {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 10px; /* Adjusted to be inside the popup content */
            cursor: pointer;
        }
    </style>
    <script>
        function openPopup() {
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="content" >
        <header>
            <div class="header-left">
                Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_apellido']); ?>
            </div>
            <div style="display: flex; align-items: center;">
                <div class="info-menu">
                    <button>Contacto</button>
                    <div class="info-menu-content">
                        <p><strong>Contacto:</strong></p>
                        <p>Email: <a href="mailto:ascorrca@gmail.com" style="color: #00d4ff; text-decoration: none;">ascorrca@gmail.com</a></p>
                        <p>Teléfono: 0212-2343135</p>
                    </div>
                </div>
                <a href="logout.php">
                    <img src="logout-icon.png" alt="Cerrar Sesión" class="logout-logo">
                </a>
            </div>
        </header>
        <div class="info-box" style="margin-top: 20px;">
            <p><strong>Cédula:</strong> <?php echo $cedula; ?></p>
            <p><strong>Correo Electrónico:</strong> <?php echo $email; ?></p>
        </div>
    </div>

</body>
</html>