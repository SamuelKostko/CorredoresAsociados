<!-- filepath: c:\wamp64\www\PROYECTO\forgot_password.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
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

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2rem;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
        }

        main {
            background: rgba(30, 30, 47, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 400px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
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

        a {
            color: #00d4ff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .success-message {
            color: green;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Recuperar Contraseña</h1>
    </header>
    <main>
        <!-- Mostrar mensajes de error o éxito -->
        
        <form action="process_forgot_password.php" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>

            <label for="contact">Correo o Teléfono:</label>
            <input type="text" id="contact" name="contact" placeholder="Ingresa tu correo o teléfono" required>

<?php if (isset($_GET['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <p class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>
<?php if (isset($_GET['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <p class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>
            <button type="submit">Enviar</button>
        </form>
        <p><a href="login.php">Volver al inicio de sesión</a></p>
    </main>
</body>
</html>