<?php
// Configuración
$destinatario = "stefanocopreni@hotmail.com"; // Reemplaza con tu dirección de email
$asunto = "Nueva suscripción a novedades de Docsketball";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la dirección de email del formulario y sanitizarla
    $email = filter_var($_POST["EMAIL"], FILTER_SANITIZE_EMAIL);
    
    // Verificar que el email sea válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Por favor, ingresa un email válido."]);
        exit;
    }
    
    // Preparar el contenido del email
    $mensaje = "Se ha registrado una nueva suscripción a las novedades de Docsketball.\n\n";
    $mensaje .= "Email del suscriptor: " . $email . "\n";
    $mensaje .= "Fecha y hora: " . date("d/m/Y H:i:s") . "\n";
    
    // Cabeceras del email
    $cabeceras = "From: Formulario Docsketball <no-reply@docsketball.com>\r\n";
    $cabeceras .= "Reply-To: " . $email . "\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();
    
    // Enviar el email
    $enviado = mail($destinatario, $asunto, $mensaje, $cabeceras);
    
    // Responder con JSON para procesamiento AJAX
    if ($enviado) {
        echo json_encode(["success" => true, "message" => "¡Gracias por suscribirte! Te mantendremos informado sobre las novedades."]);
    } else {
        echo json_encode(["success" => false, "message" => "Hubo un problema al enviar tu suscripción. Por favor, inténtalo más tarde."]);
    }
} else {
    // Si se accede directamente al archivo sin enviar el formulario
    echo json_encode(["success" => false, "message" => "Acceso no válido."]);
}
?>