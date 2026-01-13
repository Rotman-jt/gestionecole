<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../config/db.php';

$response = [
    'ok' => false,
    'errors' => [],
    'message' => ''
];

$prenom = trim($_POST['prenom'] ?? '');
$nom    = trim($_POST['nom'] ?? '');
$email  = trim($_POST['email'] ?? '');
$mdp    = $_POST['mdp'] ?? '';
$mdpv   = $_POST['mdpv'] ?? '';

// ===== VALIDATIONS =====
if ($prenom === '') {
    $response['errors']['prenom'] = "Le prénom est obligatoire";
}

if ($nom === '') {
    $response['errors']['nom'] = "Le nom est obligatoire";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['errors']['email'] = "Email invalide";
}

if (strlen($mdp) < 8) {
    $response['errors']['mdp'] = "Mot de passe trop court (8 caractères minimum)";
}

if ($mdp !== $mdpv) {
    $response['errors']['mdpv'] = "Les mots de passe ne correspondent pas";
}

if ($response['errors']) {
    echo json_encode($response);
    exit;
}

// ===== EMAIL EXISTANT =====
$check = $bdd->prepare("SELECT id FROM inscription WHERE email = ?");
$check->execute([$email]);

if ($check->rowCount()) {
    $response['errors']['email'] = "Email déjà utilisé";
    echo json_encode($response);
    exit;
}

// ===== INSERTION =====
$hash = password_hash($mdp, PASSWORD_DEFAULT);

$insert = $bdd->prepare(
    "INSERT INTO inscription (nom, prenom, email, mdp)
     VALUES (?, ?, ?, ?)"
);

$insert->execute([$nom, $prenom, $email, $hash]);

$response['ok'] = true;
$response['message'] = "🎉 Inscription réussie";

echo json_encode($response);
exit;
