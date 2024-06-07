<?php
require 'config.php';
session_start();

if (!isset($_SESSION['livreur_id'])) {
    header("Location: login.php");
    exit();
}

$livreur_id = $_SESSION['livreur_id'];

// Récupérer les informations du livreur
$stmt = $pdo->prepare("SELECT * FROM livreurs WHERE id = ?");
$stmt->execute([$livreur_id]);
$livreur = $stmt->fetch();

// Récupérer les livraisons assignées à ce livreur, triées par date de commande en ordre décroissant
$stmt = $pdo->prepare("SELECT l.*, c.nom_client, c.adresse_livraison, c.email_client, c.mode_paiement, c.date_commande 
                       FROM livraisons l 
                       JOIN commandes c ON l.commande_id = c.id 
                       WHERE l.livreur_id = ?
                       ORDER BY c.date_commande DESC");
$stmt->execute([$livreur_id]);
$livraisons = $stmt->fetchAll();

// Gérer la mise à jour du statut de livraison
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['livraison_id']) && isset($_POST['statut'])) {
    $livraison_id = $_POST['livraison_id'];
    $statut = $_POST['statut'];
    
    // Mettre à jour le statut de la livraison
    $stmt = $pdo->prepare("UPDATE livraisons SET statut = ? WHERE id = ?");
    $stmt->execute([$statut, $livraison_id]);
    
    // Rafraîchir la page pour afficher les changements
    header("Location: dashboard_livreur.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord du Livreur - Super Marché Dang-Bini</title>
    <link rel="stylesheet" href="livreur-css/dashboard.css">
</head>
<body>
<header class="header">
        <div class="div-header">
            <ul><br>
            <li style=" margin-top: -2%; color:yellow;">
            <h2 style="color:yellow;">Super Marché Dang-Bini</h2>
        </li>   
                <li class="head" style="margin-left: 10%;"><a href="../index.html">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="../catalogue.php">Catalogue de produits</a></li>
                <li class="head" style="margin-left: 1%;"><a style="color:red; font-size:20px;" href="logout_livreur.php">Se déconnecter</a></li>
            </ul>
        </div>
    </header>
   
    <br><br><br><br>

    <main style="margin:20px;">
    <h2> <?php echo htmlspecialchars($livreur['nom']); ?>, vous étes connecté en tant que livreur</h2>
        <?php if (empty($livraisons)): ?>
            <p>Aucune commande en attente pour le moment.</p>
        <?php else: ?>
            <h3>Livraisons en Attente</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du Client</th>
                        <th>Adresse de Livraison</th>
                        <th>Email du Client</th>
                        <th>Mode de Paiement</th>
                        <th>Date de Commande</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livraisons as $livraison): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livraison['id']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['nom_client']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['adresse_livraison']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['email_client']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['mode_paiement']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['date_commande']); ?></td>
                            <td><?php echo htmlspecialchars($livraison['statut']); ?></td>
                            <td>
                                <form action="dashboard_livreur.php" method="POST">
                                    <input type="hidden" name="livraison_id" value="<?php echo htmlspecialchars($livraison['id']); ?>">
                                    <select name="statut">
                                        <option value="En attente" <?php if ($livraison['statut'] == 'En attente') echo 'selected'; ?>>En attente</option>
                                        <option value="En cours de livraison" <?php if ($livraison['statut'] == 'En cours de livraison') echo 'selected'; ?>>En cours de livraison</option>
                                        <option value="Livrée" <?php if ($livraison['statut'] == 'Livrée') echo 'selected'; ?>>Livrée</option>
                                        <option value="Annulée" <?php if ($livraison['statut'] == 'Annulée') echo 'selected'; ?>>Annulée</option>
                                    </select>
                                    <button type="submit">Mettre à jour</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
