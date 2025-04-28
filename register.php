<!-- filepath: c:\wamp64\www\PROYECTO\register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <!-- Incluye la biblioteca de Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            min-height: 140vh;
        }

        header {
            text-align: center;
            margin-top: 25px;
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
            width: 600px;
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
            margin-left: 5%; /* Añade un margen izquierdo para separarlas del borde */
        }

        input, select {
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

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: -15px;
            margin-bottom: 15px;
            display: none; /* Oculto por defecto */
        }

        .login-link {
            margin-top: 20px;
            font-size: 1rem;
            color: #00d4ff;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

    </style>
    <script>
        function validatePasswords(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const errorMessage = document.getElementById('password-error');

            if (password !== confirmPassword) {
                event.preventDefault(); // Evita que el formulario se envíe
                errorMessage.style.display = 'block'; // Muestra el mensaje de error
                errorMessage.textContent = 'Las contraseñas no coinciden. Por favor, verifica e inténtalo de nuevo.';
            } else {
                errorMessage.style.display = 'none'; // Oculta el mensaje de error si todo está bien
            }
        }

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Ocultar"; // Cambia el texto del botón
            } else {
                input.type = "password";
                button.textContent = "Mostrar"; // Cambia el texto del botón
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Registrate</h1>
    </header>
    <main>
        <form action="process_register.php" method="POST" onsubmit="validatePasswords(event)">
            <label for="nombre_apellido">Nombre y Apellido:</label>
            <input type="text" id="nombre_apellido" name="nombre_apellido" placeholder="Ingresa tu nombre y apellido" required>
            
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
            
            <label for="telefono">Teléfono:</label>
            <div style="display: flex; gap: 10px; width: 93%;">
                <select id="codigo_operadora" name="codigo_operadora" style="width: 20%;" required>
                    <option value="0414" selected>0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej: 1234567" pattern="[0-9]{7}" maxlength="7" required style="flex: 1; width: 80%;">
            </div>
            
            <label for="password">Contraseña:</label>
            <div style="position: relative; width: 93%; margin-bottom: 10px;">
                <input type="password" id="password" name="password" placeholder="Crea una contraseña" minlength="6" required style="width: 96%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
                <button type="button" onclick="togglePassword('password', this)" style="position: absolute; right: 5px; top: 35%; transform: translateY(-50%); padding: 5px 10px; font-size: 0.9rem; cursor: pointer;">
                    Mostrar
                </button>
            </div>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <div style="position: relative; width: 93%; margin-bottom: 10px;">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" minlength="6" required style="width: 96%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
                <button type="button" onclick="togglePassword('confirm_password', this)" style="position: absolute; right: 5px; top: 35%; transform: translateY(-50%); padding: 5px 10px; font-size: 0.9rem; cursor: pointer;">
                    Mostrar
                </button>
            </div>

            <p id="password-error" class="error-message"></p>
            
            <?php
            if (isset($_GET['error'])) {
                $error_message = htmlspecialchars($_GET['error']);
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>
            
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php" class="login-link">Inicia sesión aquí</a></p>
    </main>
</body>
</html>