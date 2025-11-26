<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des inscriptions aux inscriptionérences</title>
</head>
<body>
<table>
        <tr>
            <th>Description</th>
            <th>Intervenant</th>
            <th>Salle</th>
            <th>Horaire</th>
            <th>Séminaire</th>
        </tr>
        
        <?php foreach($lesParticipations as $participation): ?>
        <tr>
            <td><?= htmlspecialchars($participation['description']) ?></td>
            <td><?= htmlspecialchars($participation['intervenant']['nom'] . ' ' . $participation['intervenant']['prenom']) ?></td>
            <td><?= htmlspecialchars($participation['salle']) ?></td>
            <td><?= htmlspecialchars($participation['horaire']) ?></td>
            <td><?= htmlspecialchars($participation['seminaire']['intitule']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
