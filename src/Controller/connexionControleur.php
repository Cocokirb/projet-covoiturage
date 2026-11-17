<?php

require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/connexionRepository.php';

function afficherSeConnecter(PDO $connexion): void
{
    afficherVue('connexion/index', [
        'titre' => 'Se Connecter',
        'pageCourante' => 'SeConnecter',
    ]);
}

function traiterConnexion(PDO $connexion): void
{
    $error = [];
    $email = trim($_POST['email'] ?? '');
    $motdepasse = $_POST['motdepasse'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Veuillez entrer une adresse e-mail valide.';
        }

        if ($motdepasse === '') {
            $error['motdepasse'] = 'Veuillez entrer votre mot de passe.';
        }

        if (empty($error)) {
            if (verifierConnexion($connexion, $email, $motdepasse)) {
                header('Location: index.php?action=bienvenue');
                exit();
            } else {
                $error['connexion'] = 'Adresse e-mail ou mot de passe incorrect.';
            }
        }
    }

    afficherVue('connexion/index', [
        'titre' => 'Connexion',
        'pageCourante' => 'connexion',
        'error' => $error,
        'email' => $email,
    ]);
}