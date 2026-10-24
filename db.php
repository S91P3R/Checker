<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    $seeds = [
        'S91P3R' => 'S91P3R@1999',
        'likhon' => 'S91P3R@2002',
    ];
    $exists = $pdo->prepare('SELECT id FROM users WHERE username = ?');
    $insert = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
    foreach ($seeds as $seedUser => $seedPass) {
        $exists->execute([$seedUser]);
        if ($exists->fetchColumn() === false) {
            $insert->execute([$seedUser, password_hash($seedPass, PASSWORD_DEFAULT)]);
        }
    }
    return $pdo;
}
