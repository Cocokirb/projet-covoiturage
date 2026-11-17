<?php

function recupererEnseignantParEmail(PDO $connexion, string $email): ?array
{
    $requete = 'SELECT prenomEnseignant, nomEnseignant
                FROM ENSEIGNANT
                WHERE LOWER(adressemailEnseignant) = LOWER(:email)
                LIMIT 1';

    $stmt = $connexion->prepare($requete);
    $stmt->execute(['email' => $email]);
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultat ?: null;
}

function verifierConnexion(PDO $connexion, string $email, string $motdepasse): bool
{
    $requete = 'SELECT mdpEnseignant
                FROM ENSEIGNANT
                WHERE LOWER(adressemailEnseignant) = LOWER(:email)
                LIMIT 1';

    $stmt = $connexion->prepare($requete);
    $stmt->execute(['email' => $email]);
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultat && password_verify($motdepasse, $resultat['mdpEnseignant'])) {
        return true;
    }

    return false;
}
