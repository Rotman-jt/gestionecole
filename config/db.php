<?php
try {
    $bdd = new PDO(
        "mysql:host=localhost;dbname=gestion_ecole;charset=utf8",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    echo json_encode([
        'ok' => false,
        'errors' => ['Erreur connexion base de données']
    ]);
    exit;
}
