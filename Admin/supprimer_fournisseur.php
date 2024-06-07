<?php
require 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Vérifiez si un identifiant de fournisseur est fourni dans l'URL.
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fournisseur_id = $_GET['id'];

    // Préparez une requête SQL pour supprimer le fournisseur.
    $sql = "DELETE FROM fournisseurs WHERE id = ?";

    // Utilisez des instructions préparées pour prévenir les injections SQL.
    if ($stmt = $pdo->prepare($sql)) {
        // Liez les variables à l'instruction préparée en tant que paramètres.
        $stmt->bindParam(1, $fournisseur_id, PDO::PARAM_INT);

        // Tentez d'exécuter l'instruction préparée.
        if ($stmt->execute()) {
            // Rediriger vers la page de gestion des fournisseurs après la suppression.
            header("Location: admin_dashboard.php?message=Fournisseur supprimé avec succès.");
            exit();
        } else {
            echo "Erreur: Impossible de supprimer le fournisseur.";
        }

        // Fermez la déclaration.
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête.";
    }
} else {
    // Rediriger vers la page de gestion des fournisseurs si aucun identifiant de fournisseur n'est fourni.
    header("Location: admin_dashboard.php");
    exit();
}

// Fermez la connexion à la base de données.
$pdo = null;
?>
