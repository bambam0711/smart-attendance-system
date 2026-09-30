<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

$configFile = __DIR__ . '/config.local.php';
if (!is_file($configFile)) {
    http_response_code(500);
    exit('Copy config.example.php to config.local.php and configure your local database.');
}
$config = require $configFile;
mysqli_report(MYSQLI_REPORT_OFF);
$condb = mysqli_connect(
    $config['host'],
    $config['user'],
    $config['password'],
    $config['database'],
    (int) $config['port']
);
if (!$condb) {
    http_response_code(500);
    exit('Database connection failed. Check your local configuration.');
}
mysqli_set_charset($condb, 'utf8mb4');
