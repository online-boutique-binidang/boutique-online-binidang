<?php
require 'config.php';

// Récupérer tous les produits de la base de données
$stmt = $pdo->prepare("SELECT p.*, f.nom AS fournisseur_nom FROM produits p JOIN fournisseurs f ON p.fournisseur_id = f.id");
$stmt->execute();
$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Marché Dang-Bini</title>
    <link rel="stylesheet" href="CSS/catalogue.css">
</head>

<body>
    <header class="header">
        <div class="div-header">
            <ul><br>
                <li class="head" style="margin-left: 1%;">
                    <h2>Super Marché Dang-Bini</h2>
                </li>
                <li class="head" style="margin-left: 10%;"><a href="index.html">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="catalogue.php">Catalogue des produits</a></li>
                <li class="head" style="margin-left: 1%;"><a href="Fournisseurs/login.php">Rejoignez-nous</a></li>
                <li class="head" style="margin-left: 1%;"><a href="Livreurs/status_commande.php">Status commande</a></li>
                <li style="margin-left: 1%; float: right; margin-right: 5%; background: white; border-radius: 10px; padding: 5px;">
                    <a href="panier.php">
                        <img src="images/issets/pngegg.png" alt="Panier" width="40px">
                    </a>
                    <span id="compteur-panier" style="color: rgb(255, 0, 0); margin-top: -2%;">0</span>
                </li>
            </ul>
        </div>
    </header>
    <hr>
    <br><br><br><br><br><br>

    <!-- listes de produits -->
    <main>
        <fieldset>
            <legend>Commandez nos meilleurs fruits</legend>
            <ul class="contener">
                <?php foreach ($produits as $produit) : ?>
                    <li class="st product-card">
                        <a href="#">
                            <?php if (!empty($produit['image'])) : ?>
                                <img class="content" src="Fournisseurs/<?php echo htmlspecialchars($produit['image']); ?>" alt="Image de <?php echo htmlspecialchars($produit['nom']); ?>">
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($produit['nom']); ?></h3>
                            <p><?php echo htmlspecialchars($produit['description']); ?></p>
                            <p>Prix: <?php echo htmlspecialchars($produit['prix']); ?> XAF</p>
                            <button onclick="ajouterAuPanier('<?php echo htmlspecialchars($produit['nom']); ?>', <?php echo htmlspecialchars($produit['prix']); ?>)">
                                Ajouter au panier
                            </button>
                        </a>
                    </li>
                <?php endforeach; ?>
                <br>
            </ul>
            <br>
        </fieldset>
    </main>

    <footer>
        <ul class="footer"><br><br><br>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la <br> passion de relever des défis pour vous offrir <br> la possibilité de mieux manger tout en <br> dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la <br> passion de relever des défis pour vous offrir <br> la possibilité de mieux manger tout en <br> dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux sociaux <br> <br> <br> <br>
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux sociaux <br> <br> <br> <br>
            </li>
        </ul>
    </footer>

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
