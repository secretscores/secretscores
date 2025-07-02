<?php
// URL del Apps Script (versión publicada como app web)
$google_script_url = "https://script.google.com/macros/s/AKfycbww4Gm3bMq3HtV98s9j9pBM1RVd80f-m1dyQSxJ_Q9nX0nX582Ea53-JuBZSu8FueW8/exec";

// Verifica el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Manejo de solicitud POST
    $json = file_get_contents('php://input');

    $ch = curl_init($google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    http_response_code($status);
    echo $response;

} elseif ($method === 'GET') {
    // Manejo de solicitud GET
    $ch = curl_init($google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    http_response_code($status);
    echo $response;

} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>
