<!-- filepath: c:\wamp64\www\PROYECTO\logout.php -->
<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();
session_destroy();

// Redirigir al inicio de sesión
header("Location: index.html");
exit;
?>