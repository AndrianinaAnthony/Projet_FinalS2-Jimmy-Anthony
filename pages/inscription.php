<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Créer un compte</h2>
    <form method="post" action="traitement2.php" enctype="multipart/form-data">
        <label>Nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Date de naissance :</label><br>
        <input type="date" name="date_naissance" required><br><br>

        <label>Genre :</label><br>
        <select name="genre">
            <option>Homme</option>
            <option>Femme</option>
        </select><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Ville :</label><br>
        <input type="text" name="ville" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="mdp" required><br><br>

        <label>Image de profil :</label><br>
        <input type="file" name="image_profil"><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
