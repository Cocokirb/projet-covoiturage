<section>
    <h1>Connexion</h1>

    <form method="POST" action="index.php?action=connexion" class="card-form">
        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email ?? '') ?>"
                placeholder="claude.dupont@example.com" novalidate>
            <p class="form-error"><?php echo $error['email'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse" name="motdepasse" placeholder="********" novalidate>
            <p class="form-error"><?php echo $error['motdepasse'] ?? '' ?></p>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</section>