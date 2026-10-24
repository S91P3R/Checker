<?php
declare(strict_types=1);

$dbName = 'if0_43263385_S91P3R';
$nameFile = __DIR__ . '/db_name.txt';
if (is_file($nameFile)) {
    $candidate = trim((string) file_get_contents($nameFile));
    if ($candidate !== '') {
        $dbName = $candidate;
    }
}

define('DB_HOST', 'sql101.infinityfree.com');
define('DB_PORT', 3306);
define('DB_NAME', $dbName);
define('DB_USER', 'if0_43263385');
define('DB_PASS', 'wIDQDJUWV2pq');
define('APP_NAME', 'D3M09 Login');
define('SESSION_NAME', 'd3m09_session');
