<?php
require 'config.php';
session_start();

// Vérifiez si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer tous les produits
$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll();

// Gérer la suppression de produit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produit_id'])) {
    $produit_id = $_POST['produit_id'];
    
    // Supprimer le produit de la base de données
    $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
    $stmt->execute([$produit_id]);
    
    // Rafraîchir la page pour afficher les changements
    header("Location: gerer_catalogue.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer le Catalogue de Produits</title>
    <link rel="stylesheet" href="admin-css/gestion-catalogue.css">
</head>
<body>
    <h1 style='text-align:center;' >Géstion de Catalogue de Produits</h1>
    <a href="admin_dashboard.php"><button>Retour au Tableau de Bord</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produit['id']); ?></td>
                    <td> <img width="110px" src="../Fournisseurs/<?php echo htmlspecialchars($produit['image']); ?>" alt="Image de <?php echo htmlspecialchars($produit['nom']); ?>">
                    </td>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo htmlspecialchars($produit['prix']); ?> XAF</td>
                    <td>
                        <form action="gerer_catalogue.php" method="POST">
                            <input type="hidden" name="produit_id" value="<?php echo htmlspecialchars($produit['id']); ?>">
                            <button type="submit" class="btn-supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
