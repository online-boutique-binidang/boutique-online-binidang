<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO administrateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $mot_de_passe]);
    
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Administrateur</title>
    <link rel="stylesheet" href="admin-css/admin-register.css">
</head>
<body>
    
    <form action="admin_inscription.php" method="POST">
    <h2>Inscription Administrateur</h2>
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        <input type="submit" value="S'inscrire"><br><br>
        <div class="meme">Vous avez déjà un compte?</div>
        <div class="meme">Cliquez ici pour vous <a href="admin_login.php">connecter</a></div>
    </form>
</body>
</html>
