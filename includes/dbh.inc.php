<?php
// Chargement des variables d'environement
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
define("DB_HOST", $_ENV['DB_HOST']);
define("DB_PORT", $_ENV['DB_PORT']);
define("DB_NAME", $_ENV['DB_NAME']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASSWORD", $_ENV['DB_PASSWORD']);

$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];
