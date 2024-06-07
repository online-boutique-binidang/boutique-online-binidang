<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("INSERT INTO livreurs (nom, email, mot_de_passe, telephone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $mot_de_passe, $telephone]);

    header("Location: login_livreur.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription Livreur</title>
    <link rel="stylesheet" href="livreur-css/inscription-livreur.css">
</head>
<body>
    <form method="POST">
        <h2>S'inscrire en tant que livreur</h2>
        <label for="nom">Nom:</label><br>
        <input type="text" name="nom" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" name="mot_de_passe" required><br><br>
        <label for="telephone">Téléphone:</label><br>
        <input type="text" name="telephone" required><br><br>
        <input type="submit" value="S'inscrire"><br><br>
        <div style="color:white;">Vous avez déjà un compte? <br> Cliquez ici pour vous <a href="login_livreur.php">connecter</a></div><br>
        
    </form>
</body>
</html>
