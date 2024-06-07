<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM livreurs WHERE email = ?");
    $stmt->execute([$email]);
    $livreur = $stmt->fetch();

    if ($livreur && password_verify($mot_de_passe, $livreur['mot_de_passe'])) {
        $_SESSION['livreur_id'] = $livreur['id'];
        header("Location: dashboard_livreur.php");
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion Livreur</title>
    <link rel="stylesheet" href="livreur-css/login-livreur.css">
</head>
<body>
    <form method="POST">
        <h2>Se connecter en tant que livreur</h2>
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" name="mot_de_passe" required><br><br>
        <input type="submit" value="Se connecter"><br><br>
        <div style="color:white;">Vous n'avez pas encore un compte? <br> Cliquez ici pour vous <a href="inscription_livreur.php">inscrire</a></div>
    </form>
</body>
</html>
