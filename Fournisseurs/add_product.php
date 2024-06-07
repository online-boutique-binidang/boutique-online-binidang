<?php
require 'config.php';
session_start();

$message = ''; // Variable pour stocker les messages de succès ou d'erreur

if (!isset($_SESSION['fournisseur_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $fournisseur_id = $_SESSION['fournisseur_id'];

    // Vérification et traitement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "issets/" . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, stock, image, fournisseur_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $description, $prix, $stock, $image_path, $fournisseur_id]);

            $message = "Produit ajouté avec succès!";
            header("Location: dashboard.php");
        } else {
            $message = "Erreur lors du déplacement de l'image. Vérifiez les permissions du répertoire et l'existence du répertoire de destination.";
        }
    } else {
        $message = "Veuillez sélectionner une image valide.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="fournisseur-css/add-product.css">
</head>

<body>
    <div class="container">
    
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="add_product.php" enctype="multipart/form-data">
    <h2>Ajouter un produit</h2>
    <label for="nom">Nom du produit:</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>
        <label for="prix">Prix:</label><br>
        <input type="number" id="prix" name="prix" step="0.01" required><br>
        <label for="stock">Stock:</label><br>
        <input type="number" id="stock" name="stock" required><br>
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>
        <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>