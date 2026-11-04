<section aria-labelledby="titre-inscription">
    <h1 id="titre-inscription">Crée votre compte</h1>


    <form method="POST" action="index.php?action=create" class="card-form">
        <div class="form-group">
            <label for="prenom">Prénom </label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom) ?>"
                placeholder="Claude" novalidate>
            <p class="form-error"><?php echo $error['prenom'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom) ?>" placeholder="Dupont"
                novalidate>
            <p class="form-error"><?php echo $error['nom'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>"
                placeholder="claude.dupont@example.com" novalidate>
            <p class="form-error"><?php echo $error['email'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="noTel">Numéro de téléphone</label>
            <input type="tel" id="noTel" name="noTel" value="<?php echo htmlspecialchars($noTel) ?>"
                placeholder="01 23 45 67 89" novalidate>
            <p class="form-error"><?php echo $error['noTel'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse" name="motdepasse" placeholder="********" novalidate>
            <p class="form-error"><?php echo $error['motdepasse'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="codeVerif">Code de vérification</label>
            <input type="text" id="codeVerif" name="codeVerif" placeholder="********" novalidate>
            <p class="form-error"><?php echo $error['codeVerif'] ?? '' ?></p>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Créer son compte</button>
            <a href="index.php?action=bienvenue" class="btn btn-outline">Annuler / Retour à l'accueil</a>
        </div>
    </form>
</section>