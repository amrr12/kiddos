<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=DataBase', 'root');
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
