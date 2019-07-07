<!--  REFAIRE INDENTATION !! -->
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="City Mobile est une boutique de vente et de réparation pour téléphone situé à Paris.">
    <meta name="author" content="Quentin Aslan">
    <title>City Mobile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<!-- Menu -->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">City Mobile</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <!-- Faire un menu défilant pour les articles en ventes et afficher les différentes catégories -->
        <a class="p-2 text-dark" href="?p=home">Accueil</a>
        <a class="p-2 text-dark" href="?p=liste_articles">Articles en ventes</a>
        <a class="p-2 text-dark" href="?p=liste_reparations">Réparations</a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Contact</a>
</div>

<!-- Fin Menu -->

<!-- Corp de la page -->
<?= $content; ?>
<!-- Fin Corp de la page -->

<!-- Footer -->
<div id="footer">
    <div class="container">
        <p class="text-muted credit">City Mobile 2019 © - <a class="text-warning" href="administration/index.php">Accès
                administration</a></p>
    </div>
</div>
<!-- Fin Footer -->


<!-- Optional JavaScript -->
<!-- JAVASCRIPT A REGLER APRES /!\ -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>
