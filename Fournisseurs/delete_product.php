<?php
require 'config.php';
session_start();

if (!isset($_SESSION['fournisseur_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si un identifiant de produit est fourni dans l'URL.
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];

    // Préparer une requête SQL pour supprimer le produit.
    $sql = "DELETE FROM produits WHERE id = ?";

    // Utiliser des instructions préparées pour prévenir les injections SQL.
    if ($stmt = $pdo->prepare($sql)) {
        // Lier les variables à l'instruction préparée en tant que paramètres.
        $stmt->bindParam(1, $produit_id, PDO::PARAM_INT);

        // Tenter d'exécuter l'instruction préparée.
        if ($stmt->execute()) {
            // Rediriger vers la page du tableau de bord des fournisseurs après la suppression.
            header("Location: dashboard.php?message=Produit supprimé avec succès.");
            exit();
        } else {
            echo "Erreur: Impossible de supprimer le produit.";
        }

        // Fermer la déclaration.
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête.";
    }
} else {
    // Rediriger vers la page du tableau de bord des fournisseurs si aucun identifiant de produit n'est fourni.
    header("Location: dashboard.php");
    exit();
}

// Fermer la connexion à la base de données.
$pdo = null;
?>
