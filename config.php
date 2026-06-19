<?php

declare(strict_types=1);

// Configuración de la base de datos para el localhost
const DB_HOST = '127.0.0.1';
const DB_NAME = 'basededatos'; // Asegúrate de poner el nombre final de tu TP
const DB_USER = 'root';
const DB_PASS = '';
const DB_CHARSET = 'utf8mb4';

// REVISAR RUTA: Si este archivo está en una subcarpeta, agrega /../ antes de 'database'
const DB_SQL_FILE = __DIR__ . '/db/basededatos.sql';
const DB_AUTO_DEPLOY = true;