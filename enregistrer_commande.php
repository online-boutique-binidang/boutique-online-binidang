<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $modePaiement = $_POST['mode-paiement'];
    $panier = json_decode($_POST['panier'], true);

    // Insertion de la commande dans la base de données
    $stmt = $pdo->prepare("INSERT INTO commandes (nom_client, adresse_livraison, email_client, mode_paiement) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $adresse, $email, $modePaiement]);
    $commandeId = $pdo->lastInsertId();

    // Affichage d'une confirmation de commande
    $totalCommande = array_sum(array_column($panier, 'prix'));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Commande</title>
    <link rel="stylesheet" href="CSS/enregistrer-commande.css">
</head>
<body>
<header class="header">
        <div class="div-header" >
            <ul><br>
                <li class="head" style="margin-left: 1%;">
                    <h2>Super Marché Dang-Bini</h2>
                </li>
                <li class="head" style="margin-left: 10%;"><a href="index.php">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="catalogue.php">Catalogue des produits</a></li>
                <li class="head" style="margin-left: 1%;"><a href="Fournisseurs/login.php">Rejoignez-nous</a></li>
                <li class="head" style="margin-left: 1%;"><a href="">Contactez-nous</a></li>
            </ul>
            </ul>

        </div>
        
    </header><hr>
    <br><br><br><br><br><br>
    <div class="container">
        <h1>Merci pour votre commande, <?php echo htmlspecialchars($nom); ?> !</h1>
        <p>Nous avons bien reçu votre commande et elle sera livrée à l'adresse suivante :</p>
        <div class="confirmation-details">
            <p>Adresse de livraison : <span class="highlight"><?php echo htmlspecialchars($adresse); ?></span></p>
            <p>Email du client : <span class="highlight"><?php echo htmlspecialchars($email); ?></span></p>
            <p>Mode de paiement : <span class="highlight"><?php echo htmlspecialchars($modePaiement); ?></span></p>
            <p class="total">Total de la commande : <span class="highlight"><?php echo htmlspecialchars($totalCommande); ?> XAF</span></p>
            <p><a style='color:blue;' href="Livreurs/status_commande.php">Cliquez ici pour suivre en temps réel le statut de votre commande</a> </p>
        </div>
      
    </div><br><br><br>

    <footer>
        <ul class="footer"><br><br><br>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la <br> passion de
                relever des défis pour vous offrir <br> la
                possibilité de mieux manger tout en <br> dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la <br> passion de
                relever des défis pour vous offrir <br> la
                possibilité de mieux manger tout en <br> dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux
                sociaux <br> <br> <br> <br>
            </li>

            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux
                sociaux <br> <br> <br> <br>
            </li>
        </ul>
    </footer>
</body>
</html>
