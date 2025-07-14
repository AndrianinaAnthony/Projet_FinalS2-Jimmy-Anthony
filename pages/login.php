<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="post" action="traitement1.php">
        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="mdp" required><br><br>

        <input type="submit" value="Se connecter">
    </form>

    <p>Pas encore inscrit ? <a href="inscription.php">Créer un compte</a></p>
</body>
</html>
