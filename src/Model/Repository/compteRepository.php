<?php

require_once __DIR__ . '/../../../config/database.php.php';

function insererCompte(PDO $connexion, string $prenom, string $nom, string $email, string $noTel, string $motdepasse): void
{
    $requete = "INSERT INTO utilisateurs (prenom, nom, email, noTel, motdepasse) VALUES (:prenom, :nom, :email, :noTel, :motdepasse)";
    $requete = $connexion->prepare($requete);
    $requete->execute([
        'prenom' => $prenom,
        'nom' => $nom,
        'email' => $email,
        'noTel' => $noTel,
        'motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT),
    ]);
}function recupererCodeVerif(PDO $connexion): ?string{
    $requete = "SELECT codeVerif FROM parametres";
    $requete = $connexion->prepare($requete);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    return $resultat ? $resultat['codeVerif'] : null;
}