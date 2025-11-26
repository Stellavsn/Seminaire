<main id="login-page" class="card" role="main" aria-labelledby="title">
  <h1 id="title">Se connecter</h1>
  <p class="lead">Entrez vos identifiants pour accéder à votre compte.</p>

  <form method="post">
    <div class="field">
      <label for="mail">E-mail</label>
      <input id="mail" name="mail" type="mail" required autocomplete="mail" />
    </div>
    <div class="field">
      <label for="password">Mot de passe</label>
      <input id="password" name="password" type="password" required autocomplete="current-password" />
    </div>
    <div style="margin-top:12px">
      <button type="submit">Connexion</button>
    </div>
  </form>

  <p class="muted">Pas encore de compte ? <a class="link" href="index.php?c=auth&a=register">Inscription</a></p>
</main>
