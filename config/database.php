<?php
return [
    'dsn' => getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=yereltanitim;charset=utf8mb4',
    'username' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASS') ?: '',
    'options' => [],
];
