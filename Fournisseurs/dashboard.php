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

// Récupérer les produits ajoutés par le fournisseur
$stmt = $pdo->prepare("SELECT * FROM produits WHERE fournisseur_id = ?");
$stmt->execute([$fournisseur_id]);
$produits = $stmt->fetchAll();

// Récupérer le nombre total de commandes
$stmt = $pdo->prepare("SELECT COUNT(*) AS total_commandes FROM commandes");
$stmt->execute();
$commandes = $stmt->fetch();
$total_commandes = $commandes['total_commandes'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Marché Dang-Bini</title>
    <link rel="stylesheet" href="fournisseur-css/dashboard.css">
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
                <li class="head" style="margin-left: 2%;"><a href="../catalogue.php">Catalogue des produits</a></li>
                <li class="head" style="margin-left: 2%;"><a href="add_product.php">Ajouter nouveau produit</a></li>
                <li class="head" style="margin-left: 20%;"><a style="color:red; font-size:20px;" href="logout.php">Déconnecter</a></li>
                <li style="margin-left: 1%; float: right; margin-right: 5%; background: white; border-radius: 10px; padding: 5px;">
                    <a href="notification.php">
                        <img src="../images/issets/notification.jpg" alt="Panier" width="40px">
                    </a>
                    <span id="notification_commande" style="color: rgb(255, 0, 0); margin-top: -22%; font-size:30px;"><?php echo $total_commandes; ?></span>
                </li>
            </ul>
        </div>
    </header>
    <hr>
    <br><br><br><br>
    
     <!-- listes de produits --> 
     <main style="margin:20px;">
        <!-- Informations du fournisseur -->
        <h2 style="color:blue;"><?php echo htmlspecialchars($fournisseur['nom']); ?> vous étes connecté en tant que fournisseur</h2>
        Vous vous étes inscrit le: <?php echo htmlspecialchars($fournisseur['date_inscription']); ?>
        <br><br><br>
        <fieldset>
            <legend>Retrouvez vos produits ajoutés ici</legend>
            <?php if (empty($produits)): ?>
                <p>Vous n'avez pas encore de produit.</p>
            <?php else: ?>
                <ul class="contener">
                    <?php foreach ($produits as $produit): ?>
                        <li class="st">
                            <a href="#">
                                <?php if (!empty($produit['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($produit['image']); ?>" alt="Image de <?php echo htmlspecialchars($produit['nom']); ?>">
                                <?php endif; ?>
                                <h3><?php echo htmlspecialchars($produit['nom']); ?></h3>
                                <?php echo htmlspecialchars($produit['description']); ?>
                                <br>Prix: <?php echo htmlspecialchars($produit['prix']); ?> XAF
                                <br>
                                <!-- Bouton de modification -->
                                <form action="edit_product.php" method="GET" class="style">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($produit['id']); ?>">
                                    <button type="submit">Modifier</button>
                                </form>
                                
                                <!-- Bouton de suppression -->
                                <form action="delete_product.php" method="GET" class="style">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($produit['id']); ?>">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </fieldset>
    </main>

   

    <script>
        let compteurPanier = 0;
        let panier = [];

        function ajouterAuPanier(nomProduit, prixProduit) {
            compteurPanier++;
            document.getElementById('compteur-panier').innerText = compteurPanier;
            panier.push({ nom: nomProduit, prix: prixProduit });
            localStorage.setItem('panier', JSON.stringify(panier));
        }
    </script>
</body>
</html>
