<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../config/db.php';

$response = [
    'ok' => false,
    'errors' => [],
    'message' => '',
    'message' => '',
    'nom' => '',
    'prenom' => '',
    'id' => '',


    'user'=>[]
];

$email = trim($_POST['email'] ?? '');
$mdp   = $_POST['mdp'] ?? '';

// ===== VALIDATIONS =====
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['errors']['email'] = "Email invalide";
}

if ($mdp === '') {
    $response['errors']['mdp'] = "Mot de passe obligatoire";
}

if ($response['errors']) {
    echo json_encode($response);
    exit;
}

// ===== VÉRIFICATION EMAIL =====
$req = $bdd->prepare("SELECT id, mdp,nom, prenom,email FROM inscription WHERE email = ?");
$req->execute([$email]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $response['errors']['email'] = "Aucun compte trouvé avec cet email";
    echo json_encode($response);
    exit;
}

// ===== VÉRIFICATION MOT DE PASSE =====
// if (!password_verify($mdp, $user['mdp'])) {
//     $response['errors']['mdp'] = "Mot de passe incorrect";
//     echo json_encode($response);
//     exit;
// }
if ($mdp !== $user['mdp']) {
    $response['errors']['mdp'] = "Mot de passe incorrect";
    echo json_encode($response);
    exit;
}


// ===== SUCCÈS =====
$response['user_id'] = $user['id'];
$response['prenom']  = $user['prenom'];
$response['email']  = $user['email'];
$response['user']  = $user;

$response['ok'] = true;
$response['message'] = "Connexion réussie";


echo json_encode($response);
exit;
