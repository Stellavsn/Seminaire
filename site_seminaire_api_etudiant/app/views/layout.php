<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\style.css">
    <title>Séminaire</title>
</head>
<body>
<nav>
  
  <a href="index.php">Accueil</a>
  <?php if(isset($_SESSION['mail'])){ ?>
    <a href="index.php?c=auth&a=logout">Se déconnecter</a>
    <a href="index.php?c=conference&a=listInscription"> Mes inscriptions</a>
  <?php }else{ ?>
    <a href="index.php?c=auth&a=login">Connexion</a>
  <?php } ?>

</nav>
<div>
    <?php
      $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
      $method = $trace[1]["function"];
      $controller = strtolower(str_replace("Controller","",get_class($this)));
      $viewFile = __DIR__ . "/" . $controller . "/" . $method . ".php";
      if (file_exists($viewFile)) include $viewFile;
    ?>
</div>
</body>
</html>