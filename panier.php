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
    <link rel="stylesheet" href="CSS/panier.css">
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
                <li class="head" style="margin-left: 1%;"><a href="contact.html">Contactez-nous</a></li>
            </ul>
        </div>
    </header>
    
    <br><br><br><br><br><br>
    <div class="container">
        <h2>Votre Panier</h2>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix (XAF)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="panier-produits">
                <!-- Les produits du panier seront injectés ici par JavaScript -->
            </tbody>
        </table>
        <div style='color:red;' class="total">
            Total : <span id="total-panier">0</span> XAF
        </div>

        <h2>Passer la commande</h2>
        <form id="form-commande" method="post" action="enregistrer_commande.php">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="adresse">Adresse de livraison :</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="mode-paiement">Mode de paiement :</label>
            <select id="mode-paiement" name="mode-paiement" required>
                <option value="carte">Carte de crédit</option>
                <option value="paypal">PayPal</option>
                <option value="espèces">Paiement à la livraison</option>
            </select>

            <button type="submit">Commander</button>
        </form>
    </div>

    <script>
        // Récupérer les produits du localStorage
        let panier = JSON.parse(localStorage.getItem('panier')) || [];
        const panierProduits = document.getElementById('panier-produits');
        const totalPanier = document.getElementById('total-panier');

        // Fonction pour afficher les produits dans le tableau
        function afficherPanier() {
            panierProduits.innerHTML = '';
            let total = 0;
            panier.forEach((produit, index) => {
                const tr = document.createElement('tr');
                const tdNom = document.createElement('td');
                const tdPrix = document.createElement('td');
                const tdAction = document.createElement('td');

                tdNom.textContent = produit.nom;
                tdPrix.textContent = produit.prix;

                const btnAnnuler = document.createElement('button');
                btnAnnuler.textContent = 'Annuler';
                btnAnnuler.classList.add('cancel-button');
                btnAnnuler.addEventListener('click', () => supprimerDuPanier(index));

                tdAction.appendChild(btnAnnuler);
                tr.appendChild(tdNom);
                tr.appendChild(tdPrix);
                tr.appendChild(tdAction);

                panierProduits.appendChild(tr);

                total += produit.prix;
            });

            // Afficher le total
            totalPanier.textContent = total;
        }

        // Fonction pour supprimer un produit du panier
        function supprimerDuPanier(index) {
            panier.splice(index, 1);
            localStorage.setItem('panier', JSON.stringify(panier));
            afficherPanier();
        }

        // Afficher les produits dans le panier au chargement de la page
        afficherPanier();

        // Ajouter les produits au formulaire avant l'envoi
        document.getElementById('form-commande').addEventListener('submit', function (event) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'panier';
            hiddenInput.value = JSON.stringify(panier);
            this.appendChild(hiddenInput);
        });
    </script>

    <footer>
        <ul class="footer"><br><br><br>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la passion de relever des défis pour vous offrir la possibilité de mieux manger tout en dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Marché Dang-Bini</h2>Nous travaillons avec la passion de relever des défis pour vous offrir la possibilité de mieux manger tout en dépensant moins.
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux sociaux <br><br><br><br>
            </li>
            <li class="foot">
                <h2 style="color: rgb(255, 255, 255);">Retouvez votre Supermarché</h2> Retrouvez nous sur nos réseaux sociaux <br><br><br><br>
            </li>
        </ul>
    </footer>
</body>

</html>
