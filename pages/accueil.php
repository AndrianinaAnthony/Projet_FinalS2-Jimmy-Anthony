<?php
session_start();
require('../inc/fonction.php');
require('../inc/connexion.php');
$bdd = dbconnect();

// Récupération des catégories
$sql_categorie = "SELECT * FROM categorie_objet";
$resultat_categories = mysqli_query($bdd, $sql_categorie);

// Filtrage
$id_categorie = "";
if (isset($_GET['categorie'])) {
    $id_categorie = $_GET['categorie'];
}

// Liste des objets + emprunt
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Liste des objets</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <!-- <div class="container py-5">
        <div class="mb-4 text-center">
            <h2 class="fw-bold">Bienvenue, <?php echo $_SESSION['nom_user']; ?></h2>
        </div> -->

        <div class="card shadow p-4 mb-5">
            <form method="get" action="accueil.php" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="categorie" class="form-label">Filtrer par catégorie :</label>
                    <select name="categorie" id="categorie" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Toutes les catégories --</option>
                        <?php while ($cat = mysqli_fetch_assoc($resultat_categories)) { ?>
                            <option value="<?php echo $cat['id_categorie']; ?>" 
                                <?php if ($id_categorie == $cat['id_categorie']) echo 'selected'; ?>>
                                <?php echo $cat['nom_categorie']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </form>
        </div>

        <div class="card shadow p-4">
            <h4 class="mb-3">Liste des objets</h4>
            <ul class="list-group">
                <?php while ($objet = mysqli_fetch_assoc($resultat_objets)) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?php echo $objet['nom_objet']; ?></strong><br>
                            <small class="text-muted">Catégorie : <?php echo $objet['nom_categorie']; ?></small>
                        </div>
                        <span class="badge bg-<?php echo $objet['date_retour'] ? 'warning' : 'success'; ?>">
                            <?php
                                if ($objet['date_retour']) {
                                    echo "Emprunté jusqu’au " . $objet['date_retour'];
                                } else {
                                    echo "Disponible";
                                }
                            ?>
                        </span>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</body>
</html>
