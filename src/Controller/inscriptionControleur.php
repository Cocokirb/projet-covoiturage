<?php

require_once __DIR__ . '/../View/view.php';

function afficherInscription(PDO $connexion): void
{
    afficherVue('inscription/index', [
        'titre' => 'Inscription',
        'pageCourante' => 'inscription',
    ]);
}