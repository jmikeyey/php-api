<?php

// Database credentials
$host = 'localhost'; // or your DB server
$user = 'root'; // your DB username
$password = ''; // your DB password
$dbName = 'dbtest'; // Static database name

try {
    // Connect to MySQL server without specifying a database
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '$dbName'");
    $databaseExists = $stmt->rowCount() > 0;

    if (!$databaseExists) {
        // Database doesn't exist, create it
        $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Database '$dbName' created successfully.\n";

        // Select the newly created database
        $pdo->exec("USE `$dbName`");

        // Create tables here if necessary
        $pdo->exec("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "Table 'users' created successfully.\n";

        // Insert 3 users into the users table
        $pdo->exec("INSERT INTO users (name, email) VALUES 
            ('John Doe', 'john@example.com'),
            ('Jane Doe', 'jane@example.com'),
            ('Alice Smith', 'alice@example.com')");
        echo "3 users added to the 'users' table.\n";

    } else {
        echo "Database '$dbName' already exists.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
