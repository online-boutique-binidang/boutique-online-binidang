<?php
require 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Récupérer les informations de l'administrateur
$stmt = $pdo->prepare("SELECT * FROM administrateurs WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <style>
        /* CSS styles */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a {
            text-decoration: none;
        }
        li {
            list-style: none;
        }
        img,
        ion-icon,
        a,
        button,
        time,
        span {
            display: block;
        }
        button {
            font: inherit;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }
        input,
        textarea {
            display: block;
            width: 100%;
            background: none;
            font: inherit;
        }
        ::selection {
            background: var(--orange-yellow-crayola);
            color: var(--smoky-black);
        }
        :focus {
            outline-color: var(--orange-yellow-crayola);
        }
        html {
            font-family: var(--ff-poppins);
        }
        body {
            background: var(--smoky-black);
        }
        body {
            background-image: url('main.jpg');
        }
        .header {
            background-color: rgba(0, 0, 0, 0.676);
            position: fixed;
            width: 100%;
            height: 75px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.618);
            box-shadow: 0 2px 5px rgb(0, 0, 0);
        }
        .header:active {
            background-color: aqua;
        }
        .img {
            position: absolute;
            right: 0%;
        }
        a {
            text-decoration: none;
        }
        .head {
            display: inline-block;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            transition: font-size 0.3s ease;
            color: rgb(255, 251, 251);
            margin-top: -1%;
        }
        .head a {
            color: rgb(255, 255, 255);
        }
        .head a:hover {
            color: rgb(255, 153, 0);
            font-size: 105%;
            background-color: rgb(255, 255, 255);
            font-weight: bold;
            padding: 2px;
            border-radius: 10px;
            transition-duration: 5s ease;
            transition: 0.25s ease-in;
            transition: 0.5s ease-in-out;
        }
        .st img {
            background-color: rgb(255, 255, 255);
            width: 110px;
            height: 110px;
            background: var(--eerie-black-2);
            box-shadow: 0 1px 5px;
            align-items: center;
            justify-content: center;
            transition-duration: 5s ease;
            transition: 0.25s ease-in;
            transition: 0.5s ease-in-out;
            z-index: 1;
            border-radius: 10px;
        }
        .st img:hover {
            transition: var(--transition-2);
            cursor: pointer;
            border-radius: 10px;
            justify-content: flex-start;
            width: 100px;
            height: 100px;
        }
        .st {
            display: inline-block;
            margin-left: 5%;
        }
        .st a {
            color: black;
        }
        .st a button {
            color: rgb(255, 255, 255);
            background-color: rgba(255, 0, 0, 0.801);
            padding: 3px;
            font-size: 12px;
            font-weight: bolder;
            text-shadow: 2px 0px 10px rgb(27, 26, 26);
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .st a button:hover {
            transition: 14s ease-in;
        }
        .contener {
            background-color: rgba(0, 0, 0, 0.021);
            margin-left: 3%;
            margin-right: 3%;
            border-radius: 25px;
            border: 1px solid rgb(255, 255, 255);
            padding: 1%;
            gap: 25px;
        }
        .foot {
            display: inline-block;
            margin-left: 15px;
            color: aliceblue;
        }
        footer {
            background: rgba(0, 0, 0, 0.815);
            padding-bottom: 5%;
        }
        #compteur-panier {
            position: absolute;
            font-size: 30px;
        }
        .div-header {
        }
        .style {
            display: inline-block;
        }
        th{
            background:black;
            color:white;
            text-align:center;
            padding:5px;
        }
        table{
            width:100%;
            padding:15px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="div-header">
            <ul><br>
                <li class="head" style="margin-left: 1%;">
                    <div style="color:yellow"><?php echo htmlspecialchars($admin['nom']); ?></div>
                    <?php echo htmlspecialchars($admin['email']); ?><br>
                </li>
                <li class="head" style="margin-left: 10%;"><a href="../index.html">Accueil</a></li>
                <li class="head" style="margin-left: 1%;"><a href="../catalogue.php">Catalogue de produits</a></li> 
                <li class="head" style="margin-left: 1%;"><a href="gerer_catalogue.php">Gérer les produits</a></li> 
               
                <li class="head" style="margin-left: 30%; color:red;"><a style="color:red; font-size:20px;" href="logout_admin.php">Déconnecter</a></li>
            </ul>
        </div>
    </header>
    <hr>
    <br><br><br><br>
    
    <main style="margin:20px;">
        <!-- Contenu du tableau de bord de l'administrateur -->
        <h2><span style='color:green;'><?php echo htmlspecialchars($admin['nom']); ?></span> c'est vous l'aministrateur, vous avez le pouvoir !!!</h2>
        
        <p>Bienvenue sur votre tableau de bord en tant que administrateur .</p>
        <p>Vous pouvez ici gérer les privilèges, ajouter ou supprimer des produits, des fournisseurs, des livreurs, etc.</p><br><br>
        
       
        <table border="1" cellpadding="5" cellspacing="0">
        <h2>Gestion des Fournisseurs</h2>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            // Récupérer tous les fournisseurs
            $stmt = $pdo->query("SELECT * FROM fournisseurs");
            while ($fournisseur = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fournisseur['id']) . "</td>";
                echo "<td>" . htmlspecialchars($fournisseur['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($fournisseur['email']) . "</td>";
                echo "<td><a href='supprimer_fournisseur.php?id=" . htmlspecialchars($fournisseur['id']) . "'>Supprimer</a></td>";
                echo "</tr>";
            }
            ?>
        </table><br><br>

      
        <table border="1" cellpadding="5" cellspacing="0">
        <h2>Gestion des Livreurs</h2>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
               
            </tr>
            <?php
            // Récupérer tous les livreurs
            $stmt = $pdo->query("SELECT * FROM livreurs");
            while ($livreur = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($livreur['id']) . "</td>";
                echo "<td>" . htmlspecialchars($livreur['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($livreur['email']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
</body>
</html>
