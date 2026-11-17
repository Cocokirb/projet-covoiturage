<?php

function verifierConnexion(PDO $connexion, string $email, string $motdepasse): bool
{
    $stmt = $connexion->prepare('SELECT motdepasse FROM comptes WHERE email = :email');
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultat && password_verify($motdepasse, $resultat['motdepasse'])) {
        return true;
    }

    return false;
}
