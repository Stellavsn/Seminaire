<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de conférence</title>
</head>
<body>
    <form method="POST" action="">
    <label for="seminaire_id">Sélectionnez un séminaire :</label>
    <select name="seminaire_id" id="seminaire_id" onchange="this.form.submit()">
        <option value="" disabled selected>-- Choisir un séminaire --</option>

        <?php if(!empty($lesSeminaires)): ?>
            <?php foreach($lesSeminaires as $semi): ?>
                <option value="<?= htmlspecialchars($semi['numSemi']) ?>"
                    <?= (isset($_POST['seminaire_id']) && $_POST['seminaire_id']==$semi['numSemi']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($semi['intitule']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Aucun séminaire disponible</option>
        <?php endif; ?>
    </select>
</form>



    <p>
        <?php 
        if(isset($_SESSION['mail'])){
            if (!empty($resultat)){ 
                echo $resultat['message']; } else{
                //echo 'Participant déjà inscrit';
                }
            }?>
    </p>

<table>
        <tr>
            <th>Description</th>
            <th>Intervenant</th>
            <th>Salle</th>
            <th>Horaire</th>
            <th>Séminaire</th>
            <th>Action</th>
        </tr>
        <?php foreach($lesConferences as $conf): ?>
        <tr>
            <td><?= htmlspecialchars($conf['description']) ?></td>
            <td><?= htmlspecialchars($conf['intervenant']['nom'] . ' ' . $conf['intervenant']['prenom']) ?></td>
            <td><?= htmlspecialchars($conf['salle']) ?></td>
            <td><?= htmlspecialchars($conf['horaire']) ?></td>
            <td><?= htmlspecialchars($conf['seminaire']['intitule']) ?></td>
            <td>
            <?php if(isset($_SESSION['numParticipant'])){ ?>
                <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($conf['id'] ?? '') ?>">

                <button type="submit" name="inscire">S'inscrire</button>
                </form>
            <?php }else{ ?>
                <a href='index.php?c=auth&a=login'>Connexion requise</a>
            <?php } ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
