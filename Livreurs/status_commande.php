<?php
require 'config.php';

// Récupérer toutes les commandes et leurs statuts, triées par date de commande en ordre décroissant
$stmt = $pdo->prepare("SELECT c.id, c.nom_client, c.adresse_livraison, c.email_client, c.mode_paiement, c.date_commande, l.statut
                       FROM commandes c
                       LEFT JOIN livraisons l ON c.id = l.commande_id
                       ORDER BY c.date_commande DESC");
$stmt->execute();
$commandes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="livreur-css/statut-commande.css">
</head>
<body>
<header class="header">
        <div class="div-header">
            <ul><br>
                <li class="head" style="margin-left: 1%;">
                    <h2 style="color:yellow;">Super Marché Dang-Bini</h2>
                </li>
                <li class="head" style="margin-left: 10%;"><a href="../index.html">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="../catalogue.php">Catalogue des produits</a></li>
                <li class="head" style="margin-left: 1%;"><a href="../Fournisseurs/login.php">Rejoignez-nous</a></li>
                
            </ul>
        </div>
    </header>

    <div class="container"><br><br>
        <h2>Suivez le status de votre commande en temps réel</h2>
        <?php if (empty($commandes)): ?>
            <p>Aucune commande disponible pour le moment.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Nom du Client</th>
                        <th>Adresse de Livraison</th>
                        <th>Email du Client</th>
                        <th>Mode de Paiement</th>
                        <th>Date de Commande</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($commande['id']); ?></td>
                            <td><?php echo htmlspecialchars($commande['nom_client']); ?></td>
                            <td><?php echo htmlspecialchars($commande['adresse_livraison']); ?></td>
                            <td><?php echo htmlspecialchars($commande['email_client']); ?></td>
                            <td><?php echo htmlspecialchars($commande['mode_paiement']); ?></td>
                            <td><?php echo htmlspecialchars($commande['date_commande']); ?></td>
                            <td><?php echo htmlspecialchars($commande['statut'] ?? 'En attente'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
