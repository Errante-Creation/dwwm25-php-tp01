<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'villes_monde_db';
$username = 'root';
$password = '';

try {
   // Création de la connexion PDO
   $pdo = new PDO(
      "mysql:host=$host;dbname=$dbname;charset=utf8",
      $username,
      $password,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );
} catch (PDOException $e) {
   die("Erreur de connexion : ".$e->getMessage());
}