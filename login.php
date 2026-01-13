<?php
session_start();
header('Content-Type: application/json');

/* vérification utilisateur */
if ($loginOK) {
    $_SESSION['user_id'] = $user['id'];   // CLÉ PRINCIPALE
    $_SESSION['username'] = $user['nom'];

    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'message' => 'Login incorrect']);
}
?>