<!-- filepath: c:\wamp64\www\PROYECTO\login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesion</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Estilos futuristas */
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
            font-size: 2.5rem;
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: left;
            align-self: flex-start; /* Alinea las etiquetas al margen izquierdo */
            margin-left: 5%;
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
            margin-bottom: 10px;
        }

        button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .register-link {
            margin-top: 20px;
            font-size: 1rem;
            color: #00d4ff;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .forgot-password-link {
            font-size: 1rem;
            color: #00d4ff;
            text-decoration: none;
            margin-top: 10px;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
        }

        footer {
            position: absolute;
            bottom: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Ocultar";
            } else {
                input.type = "password";
                button.textContent = "Mostrar";
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>
    <main>
        <form action="process_login.php" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>
            <label for="password">Contraseña:</label>
            <div style="position: relative; width: 95%; ">
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required style="width: 94%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
                <button type="button" onclick="togglePassword('password', this)" style="position: absolute; right: 5px; top: 35%; transform: translateY(-50%); padding: 5px 10px; font-size: 0.9rem; cursor: pointer;">
                    Mostrar
                </button>
            </div>
            <p style="text-align: right; width:95%;">
                <a href="forgot_password.php" class="forgot-password-link">¿Olvidaste tu contraseña?</a>
            </p>
            <?php
            if (isset($_GET['error'])) {
                $error_message = htmlspecialchars($_GET['error']);
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>
            <button type="submit">Ingresar</button>
        </form>
        <p>¿No tienes cuenta? <a href="register.php" class="register-link">Crea una aquí</a></p>
    </main>
</body>
</html>