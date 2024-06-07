<?php
require 'config.php';
session_start();

if (!isset($_SESSION['fournisseur_id'])) {
    header("Location: login.php");
    exit();
}

$fournisseur_id = $_SESSION['fournisseur_id'];

// Récupérer les informations du fournisseur
$stmt = $pdo->prepare("SELECT * FROM fournisseurs WHERE id = ?");
$stmt->execute([$fournisseur_id]);
$fournisseur = $stmt->fetch();

// Récupérer toutes les commandes
$stmt = $pdo->prepare("SELECT * FROM commandes");
$stmt->execute();
$commandes = $stmt->fetchAll();

// Récupérer tous les livreurs
$stmt = $pdo->prepare("SELECT * FROM livreurs");
$stmt->execute();
$livreurs = $stmt->fetchAll();

// Gérer l'association de livraison à un livreur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commande_id']) && isset($_POST['livreur_id'])) {
    $commande_id = $_POST['commande_id'];
    $livreur_id = $_POST['livreur_id'];
    
    // Insérer la nouvelle livraison
    $stmt = $pdo->prepare("INSERT INTO livraisons (commande_id, livreur_id) VALUES (?, ?)");
    $stmt->execute([$commande_id, $livreur_id]);
    
    echo "<p style='color: green;'>Livraison associée avec succès !</p>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Commandes - Super Marché Dang-Bini</title>
    <link rel="stylesheet" href="fournisseur-css/notification.css">
</head>
<body>
    <header class="header">
        <div class="div-header">
            <ul><br>
                <li class="head" style="margin-left: 1%;">
                    <div style="color:yellow"><?php echo htmlspecialchars($fournisseur['nom']); ?></div>
                    <?php echo htmlspecialchars($fournisseur['email']); ?><br>
                </li>
                <li class="head" style="margin-left: 10%;"><a href="../index.html">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="../catalogue.php">Catalogue des produits</a></li>
                <li class="head" style="margin-left: 40%;"><a style='color:red; font-size:20px;' href="logout.php">Se déconnecter</a></li>
               
            </ul>
        </div>
    </header>
    <hr>
    <br><br><br><br>

    <main style="margin:20px;">
        <h2>Historique des Commandes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Client</th>
                    <th>Adresse de Livraison</th>
                    <th>Email du Client</th>
                    <th>Mode de Paiement</th>
                    <th>Date de Commande</th>
                    <th>Assigner un Livreur</th>
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
                    <td>
                        <form action="notification.php" method="POST">
                            <input type="hidden" name="commande_id" value="<?php echo htmlspecialchars($commande['id']); ?>">
                            <select name="livreur_id">
                                <?php foreach ($livreurs as $livreur): ?>
                                    <option value="<?php echo htmlspecialchars($livreur['id']); ?>"><?php echo htmlspecialchars($livreur['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Assigner</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main><br><br><br><br><br><br><br><br><br><br>

    <footer>
        <ul class="footer"><br><br><br>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la <br> passion de
                relever des défis pour vous offrir <br> la
                possibilité de mieux manger tout en <br> dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux
                sociaux <br> <br> <br> <br>
            </li>
        </ul>
    </footer>
</body>
</html>
