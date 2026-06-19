<?php
// app/models/model.php

// Incluimos el archivo de configuración que está en la raíz
require_once __DIR__ . '/../../config.php';

class Model {
    protected $db;

    public function __construct() {
        try {
            // CORREGIDO: Guardar en el atributo de clase para que lo hereden los hijos
            $this->db = $this->getDatabaseConnection();
        } catch (Exception $e) {
            echo "<h1>Falló el despliegue de la Base de Datos</h1>";
            echo "<p><strong>Mensaje de error:</strong> " . $e->getMessage() . "</p>";
            die(); 
        }
    }

    protected function getDatabaseConnection(): PDO
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // El código 1049 significa "Base de datos desconocida/inexistente"
            if ($e->getCode() === 1049 && DB_AUTO_DEPLOY) {
                return $this->deployDatabase($options);
            }

            // Si es otro error (ej: contraseña incorrecta) o el deploy está apagado, relanzamos el error
            throw $e;
        }
    }

    protected function deployDatabase(array $options): PDO
    {
        // 1. Conectamos al servidor de MySQL de forma general (sin seleccionar BD)
        $dsnGeneral = sprintf('mysql:host=%s;charset=%s', DB_HOST, DB_CHARSET);
        $pdoGeneral = new PDO($dsnGeneral, DB_USER, DB_PASS, $options);

        // 2. Creamos la base de datos vacía
        $pdoGeneral->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` DEFAULT CHARACTER SET ' . DB_CHARSET . ' COLLATE utf8mb4_unicode_ci');

        // 3. Nos conectamos formalmente a la base de datos recién nacida
        $dsnFinal = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $pdo = new PDO($dsnFinal, DB_USER, DB_PASS, $options);

        // 4. Verificamos y ejecutamos el archivo SQL de forma masiva y limpia
        if (!file_exists(DB_SQL_FILE)) {
            throw new Exception("Error en AutoDeploy: No se encontró el archivo SQL en la ruta: " . DB_SQL_FILE);
        }

        $sql = file_get_contents(DB_SQL_FILE);
        if ($sql === false) {
            throw new Exception("Error en AutoDeploy: No se pudo leer el archivo SQL.");
        }

        // PDO ejecuta todo el bloque respetando transacciones e inserts complejos sin romperse
        $pdo->exec($sql);

        return $pdo;
    }
}