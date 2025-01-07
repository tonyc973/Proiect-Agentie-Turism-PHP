<?php
require_once "config/routes.php";
require_once "config/pdo.php"; 

session_start();



function validateRequestOrigin() {
    $allowed_origin = 'tony.roglia.ro';
    $allowed_referer = 'tony.roglia.ro';

    // Check the Origin header (for cross-origin requests, like API calls)
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        $origin = parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST);
        if ($origin !== $allowed_origin) {
            die('Invalid request origin');
        }
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        if ($referer !== $allowed_referer) {
            die('Invalid referer');
        }
    }
}

validateRequestOrigin();


$router = new Router();
$router->direct();
?>