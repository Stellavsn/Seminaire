<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Inscription</title>
<?php require_once __DIR__ . '/../layout.php'; ?>
</head>
<body>
  <main id="register-page" class="card">
    <h1>Créer un compte</h1>
    <p>Remplissez les champs pour vous inscrire.</p>

    <form method="post">
      <div class="field">
        <label for="nom">Nom *</label>
        <input type="text" id="nom" name="nom" required>
      </div>

      <div class="field">
        <label for="prenom">Prénom *</label>
        <input type="text" id="prenom" name="prenom" required>
      </div>

      <div class="field">
        <label for="profession">Profession</label>
        <input type="text" id="profession" name="profession">
      </div>

      <div class="field">
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville">
      </div>

      <div class="field">
        <label for="mail">E-mail *</label>
        <input type="mail" id="mail" name="mail" required>
      </div>

      <div class="field">
        <label for="password">Mot de passe *</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">S'inscrire</button>
    </form>

    <p class="link">
      Déjà un compte ? <a href="index.php?c=Auth&a=login">Se connecter</a>
    </p>
  </main>
</body>
</html>