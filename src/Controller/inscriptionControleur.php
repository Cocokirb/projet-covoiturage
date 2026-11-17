<?php

require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/compteRepository.php';

function afficherInscription(PDO $connexion): void
{
    afficherVue('inscription/index', [
        'titre'        => 'Inscription',
        'pageCourante' => 'inscription',
        'error'        => [],
        'nom'          => '',
        'prenom'       => '',
        'email'        => '',
        'noTel'        => '',
    ]);
}

function traiterInscription(PDO $connexion): void
{
    $error      = [];
    $nom        = trim($_POST['nom'] ?? '');
    $prenom     = trim($_POST['prenom'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $noTel      = trim($_POST['noTel'] ?? '');
    $motdepasse = $_POST['motdepasse'] ?? '';
    $codeVerif  = trim($_POST['codeVerif'] ?? '');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($nom === '' || strlen($nom) < 3) {
            $error['nom'] = 'Le nom doit contenir au moins 3 caractères.';
        }

        if ($prenom === '' || strlen($prenom) < 3) {
            $error['prenom'] = 'Le prénom doit contenir au moins 3 caractères.';
        }

        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Veuillez entrer une adresse e-mail valide.';
        } elseif (emailExiste($connexion, $email)) {
            $error['email'] = "L'adresse mail est déjà utilisé";
        }

        $noTelValide = preg_match('/^(0|\+33)[1-9](\d{8})$/', $noTel) === 1 || preg_match('/^\d{10}$/', $noTel) === 1;
        if ($noTel === '' || $noTelValide === false) {
            $error['noTel'] = 'Veuillez entrer un numéro de téléphone valide (10 chiffres).';
        }

        if ($motdepasse === '' || strlen($motdepasse) < 8) {
            $error['motdepasse'] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        $codeValide = recupererCodeVerif($connexion);
        if ($codeVerif === '' || $codeValide === null || $codeVerif !== $codeValide) {
            $error['codeVerif'] = 'Le code de vérification est incorrect.';
        }

        if (empty($error)) {
            insererCompte($connexion, $prenom, $nom, $email, $noTel, $motdepasse);

            afficherVue('inscription/index', [
                'titre'        => 'Inscription',
                'pageCourante' => 'inscription',
                'error'        => [],
                'nom'          => '',
                'prenom'       => '',
                'email'        => '',
                'noTel'        => '',
                'success'      => 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.',
            ]);
            return;
        }

        afficherVue('inscription/index', [
            'titre'        => 'Inscription',
            'pageCourante' => 'inscription',
            'error'        => $error,
            'nom'          => $nom,
            'prenom'       => $prenom,
            'email'        => $email,
            'noTel'        => $noTel,
        ]);
    }
}
