<section class="jumbotron text-center" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <h1 class="jumbotron-heading">City Mobile</h1>
        <p class="lead text-muted">
            Vente et réparation de téléphones
        </p>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 alert alert-light" role="alert">
                <h4 class="alert-heading">Coordonnées</h4>
                <p>
                    Centre commercial Leclerc
                    <br> 19 rue du Pré Saint Gervais - 93500 Pantin
                    <br>
                    Tel : <a href="tel:0148401790">01.48.40.17.90</a>
                </p>
                <hr>
                <p class="mb-0">
                    Métro Hoche
                    <br>
                    <strong>10h-20h du Lundi au Samedi</strong>
                </p>
            </div>
            <div class="col-lg-5"></div>
        </div>

        <p>
            <a href="index.php?p=list_articles" class="btn btn-lg btn-info">Liste de nos articles</a>
        </p>
    </div>
</section>

<div class="container">
    <div class="pricing-header px-3 py-3 mx-auto text-center">
        <h1 class="display-9">Derniers articles </h1>
    </div>
    <div class="row">
        <?php $this->viewArticle($articles); ?>
    </div>
    <br>
    <p class="text-center">
        <a href="index.php?p=list_articles" class="btn btn-lg btn-info">Liste de nos articles</a>
    </p>
</div>