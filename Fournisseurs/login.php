<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM fournisseurs WHERE email = ?");
    $stmt->execute([$email]);
    $fournisseur = $stmt->fetch();

    if ($fournisseur && password_verify($mot_de_passe, $fournisseur['mot_de_passe'])) {
        $_SESSION['fournisseur_id'] = $fournisseur['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<h2>Email ou mot de passe incorrect.</h2>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="fournisseur-css/login-fournisseur.css">
</head>

<body>
    <div class="container">

        <form method="POST">
            <h1>Connexion</h1>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="mot_de_passe">Mot de passe :</label><br>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
            
            <input type="submit" value="Se connecter"><br><br>
            
            <div class="meme">Vous n'avez pas encore un compte?</div><br>
            <div class="meme">Cliquez ici pour vous <a href="register.php">inscrire</a></div>
        </form>
    </div>
</body>

</html>