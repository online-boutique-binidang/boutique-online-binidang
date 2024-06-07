<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO fournisseurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $mot_de_passe]);
        echo "<h2>Inscription réussie!</h2>";
        header("Location: dashboard.php");
        exit();
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo " <h2>Erreur: cet email est déjà utilisé.</h2>";
        } else {
            echo "Erreur: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Fournisseur</title>
   <link rel="stylesheet" href="fournisseur-css/register-fournisseur.css">
</head>

<body>
    <div class="container">
       
    <form method="POST">
    <h2>Inscrivez-vous en tant que <br> fournisseur</h2>
        <label for="nom">Nom:</label><br>
        <input type="text" name="nom" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        <button type="submit">S'inscrire</button><br><br>
        <div class="meme">Vous avez déjà un compte?</div>
        <div class="meme">Cliquez ici pour vous <a href="login.php">connecter</a></div>
        </form>
    </div>
</body>

</html>