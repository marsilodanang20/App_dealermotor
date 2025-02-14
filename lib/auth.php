<?php
session_start();
require_once __DIR__ . "/../vendor/autoload.php"; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();
$base = $_ENV["BASE_URL"];
if (!isset($_SESSION['email'])) {
    header("Location: ".$base."login.php"); // Redirect to your login page
    exit();
}
?>
