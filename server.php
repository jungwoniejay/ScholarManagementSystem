<?php
// server.php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Serve existing files if they exist in /public
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Route all other requests to Laravel
require_once __DIR__ . '/public/index.php';
