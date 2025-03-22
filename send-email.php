<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['EMAIL'];

    // Validar el correo
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Configurar el correo
        $to = "stefanocopreni@hotmail.com";  // Cambia esto por tu correo
        $subject = "Nuevo Suscriptor - Notificación";
        $message = "Se ha suscrito un nuevo usuario con el siguiente correo: " . $email;
        $headers = "From: no-reply@tudominio.com" . "\r\n" .
                   "Reply-To: no-reply@tudominio.com" . "\r\n" .
                   "Content-Type: text/html; charset=UTF-8";

        // Enviar el correo
        if (mail($to, $subject, $message, $headers)) {
            echo "Gracias por suscribirte!";
        } else {
            echo "Hubo un problema al enviar tu suscripción. Intenta de nuevo.";
        }
    } else {
        echo "Por favor, ingresa un correo válido.";
    }
} else {
    // Redirigir si alguien accede al script directamente
    header("Location: index.html");
    exit();
}
?>
