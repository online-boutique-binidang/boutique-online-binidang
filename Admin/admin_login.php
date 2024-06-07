<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    $stmt = $pdo->prepare("SELECT * FROM administrateurs WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $erreur = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <style>
        body {
            background-color:rgba(0, 0, 0, 0.918);
            margin: 0%;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        form {
            background-color: rgba(0, 0, 0, 0.089);
            position: absolute;
            height: 60%;
            width: 50%;
            border-radius: 20px 20px 20px 20px;
            box-shadow: 1px 1px 4px;
            border: solid white 2px;
            margin-left: 25%;
            margin-top: 5%;
            padding: 25px;
        }

        form input {
            
            border: 1px solid grey;
            width: 50%;
            padding: 5px;
            font-size: 120%;
            border-radius: 10px 10px 10px 10px;
            color: black;

        }
        input[type="submit"]{
            box-shadow: 1px 1px 5px;
            border: 1px solid rgb(153, 153, 155);
            width: 50%;
            padding: 5px;
            font-size: 120%;
            border-radius: 10px 10px 10px 10px;
            background-color: rgba(0, 0, 0, 0.418);
            color: rgba(255, 208, 0, 0.925);
        }
        h1{
            color: yellow;
        }
        h2{
            color:white;
        }
        label{
            color: white;
            margin: 10px;
        }
        input:hover {
            background-color: rgba(251, 255, 0, 0.849);
            color: black;
        }
        .meme{
            color: white;
        }
        a{
            color: rgb(0, 255, 21);
            text-decoration: none;
        }
    </style>
</head>
<body>
   
    <?php if (isset($erreur)): ?>
        <p><?php echo $erreur; ?></p>
    <?php endif; ?>
    <form action="admin_login.php" method="POST">
    <h2>Connexion Administrateur</h2>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        <input type="submit" value="Se connecter"><br><br>
    </form>
</body>
</html>
