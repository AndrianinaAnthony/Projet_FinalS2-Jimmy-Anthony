<?php
session_start();
require('../inc/fonction.php');
require('../inc/connexion.php');
$bdd = dbconnect();

// Récupération des catégories pour le filtre
$sql_categorie = "SELECT * FROM categorie_objet";
$resultat_categories = mysqli_query($bdd, $sql_categorie);

// Filtrage par catégorie (via GET)
$id_categorie = "";
if (isset($_GET['categorie'])) {
    $id_categorie = $_GET['categorie'];
}

// Requête principale pour récupérer les objets et la date de retour
$sql = "SELECT objet.*, categorie_objet.nom_categorie, emprunt.date_retour 
        FROM objet
        INNER JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
        LEFT JOIN emprunt ON objet.id_objet = emprunt.id_objet";

if ($id_categorie !== "") {
    $sql .= " WHERE objet.id_categorie = " . $id_categorie;
}

$resultat_objets = mysqli_query($bdd, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil - Liste des objets</title>
</head>
<body>
    <h2>Bienvenue <?php echo $_SESSION['nom_user']; ?></h2>

    <form method="get" action="accueil.php">
        <label>Filtrer par catégorie :</label>
        <select name="categorie" onchange="this.form.submit()">
            <option value="">-- Toutes les catégories --</option>
            <?php while ($cat = mysqli_fetch_assoc($resultat_categories)) { ?>
                <option value="<?php echo $cat['id_categorie']; ?>" 
                    <?php if ($id_categorie == $cat['id_categorie']) echo 'selected'; ?>>
                    <?php echo $cat['nom_categorie']; ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <h3>Liste des objets</h3>
    <ul>
        <?php while ($objet = mysqli_fetch_assoc($resultat_objets)) { ?>
            <li>
                <?php echo $objet['nom_objet']; ?> 
                (Catégorie : <?php echo $objet['nom_categorie']; ?>)
                — 
                <?php
                    if ($objet['date_retour'] != null) {
                        echo "Emprunté jusqu’au " . $objet['date_retour'];
                    } else {
                        echo "Disponible";
                    }
                ?>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
