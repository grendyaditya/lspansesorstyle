<?php
// config/db.php
try {
    $conn = new PDO("mysql:host=localhost;dbname=manajemen_inventory", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
