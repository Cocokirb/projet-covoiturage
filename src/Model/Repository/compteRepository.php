<?php

require_once __DIR__ . '/../../../config/database.php';

function insererCompte(PDO $connexion, string $prenom, string $nom, string $email, string $noTel, string $motdepasse): void
{
    $idMax        = (int) $connexion->query('SELECT COALESCE(MAX(idEnseignant), 0) FROM ENSEIGNANT')->fetchColumn();
    $idEnseignant = $idMax + 1;

    $requete = "INSERT INTO ENSEIGNANT (idEnseignant, nomEnseignant, prenomEnseignant, adressemailEnseignant, numeroTelEnseignant, mdpEnseignant)
        VALUES (:idEnseignant, :nomEnseignant, :prenomEnseignant, :adressemailEnseignant, :numeroTelEnseignant, :mdpEnseignant)";

    $stmt = $connexion->prepare($requete);
    $stmt->execute([
        'idEnseignant'          => $idEnseignant,
        'nomEnseignant'         => $nom,
        'prenomEnseignant'      => $prenom,
        'adressemailEnseignant' => $email,
        'numeroTelEnseignant'   => $noTel,
        'mdpEnseignant'         => password_hash($motdepasse, PASSWORD_DEFAULT),
    ]);
}

function recupererCodeVerif(PDO $connexion): ?string
{
    $requete = "SELECT code FROM parametres LIMIT 1";
    $stmt    = $connexion->prepare($requete);
    $stmt->execute();
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultat ? $resultat['code'] : null;
}

function emailExiste(PDO $connexion, string $email): bool
{
    $requete = "SELECT 1 FROM ENSEIGNANT WHERE LOWER(adressemailEnseignant) = LOWER(:email) ";
    $stmt    = $connexion->prepare($requete);
    $stmt->execute(['email' => $email]);

    return $stmt->fetchColumn();
}
