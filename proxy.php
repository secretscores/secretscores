<?php
// URL de tu Apps Script (versión /exec pública)
$google_script_url = "https://script.google.com/macros/s/AKfycbww4Gm3bMq3HtV98s9j9pBM1RVd80f-m1dyQSxJ_Q9nX0nX582Ea53-JuBZSu8FueW8/exec";

// Verificamos que sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos el cuerpo de la solicitud
    $json = file_get_contents('php://input');

    // Inicializamos cURL
    $ch = curl_init($google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    // Ejecutamos la solicitud y obtenemos la respuesta
    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Devolvemos la respuesta
    http_response_code($status);
    echo $response;
} else {
    http_response_code(405); // Método no permitido
    echo "Método no permitido";
}
?>