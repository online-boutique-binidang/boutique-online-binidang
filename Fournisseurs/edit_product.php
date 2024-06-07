<?php
require 'config.php';
session_start();

if (!isset($_SESSION['fournisseur_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $produit_id = $_GET['id'];

    // Vérifier si le produit appartient bien au fournisseur actuel
    $fournisseur_id = $_SESSION['fournisseur_id'];
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ? AND fournisseur_id = ?");
    $stmt->execute([$produit_id, $fournisseur_id]);
    $produit = $stmt->fetch();

    if (!$produit) {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Modification des données du produit dans la base de données
    $stmt = $pdo->prepare("UPDATE produits SET nom = ?, description = ?, prix = ?, stock = ? WHERE id = ?");
    $result = $stmt->execute([$nom, $description, $prix, $stock, $produit_id]);

    // Vérifier si la requête a réussi
    if ($result) {
        // Rediriger vers la page de tableau de bord avec un message de succès
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        // En cas d'échec de la requête, afficher un message d'erreur
        echo "Erreur lors de la mise à jour du produit.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
   <link rel="stylesheet" href="fournisseur-css/edit-product.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <h1>Modifier un Produit</h1>
            <!-- Champs du formulaire -->
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($produit['nom']); ?>" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($produit['description']); ?></textarea><br><br>
            <label for="prix">Prix:</label><br>
            <input type="number" id="prix" name="prix" min="0" step="0.01" value="<?php echo htmlspecialchars($produit['prix']); ?>" required><br><br>
            <label for="stock">Stock:</label><br>
            <input type="number" id="stock" name="stock" min="0" value="<?php echo htmlspecialchars($produit['stock']); ?>" required><br><br>
            <!-- Bouton de soumission -->
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>
