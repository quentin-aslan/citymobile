<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Articles en vente</h1>
    <p class="lead">Voici touts les téléphones en vente dans notre magasin</p>
</div>

<div class="container">
    <div class="card-deck col-lg-12 text-center">

        <?php
        /** @var ArrayObject $articles */
        $i = 0;
        foreach ($articles as $article) {
            $i++;
            /** @var \citymobile\Article $article */
        if($i==4){?>

        <div class="card col-lg-3 col-md-12 mb-3 shadow-sm">
            <img class="card-img-top" width="286" height="180" src="img/articles/<?= $article->getPhoto(); ?>" alt="<?= $article->getName(); ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $article->getName(); ?></h5>
                <ul class="list-unstyled mt-3 mb-4">
                    <h3 class="card-title pricing-card-title"><?= $article->getPrice(); ?>€ <small class="text-muted"></small></h3>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary"" data-toggle="modal" data-target="#article_<?= $article->getId(); ?>"> Voir plus</button>
            </div>
        </div>
    </div>
    <div class="card-deck col-lg-12 text-center">
        <?php
        $i=0;
        }else{
            ?>
            <div class="card col-lg-3 col-md-12  mb-3 shadow-sm">
                <img class="card-img-top" width="286" height="180" src="img/articles/<?= $article->getPhoto(); ?>" alt="<?= $article->getName(); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getName(); ?></h5>
                    <ul class="list-unstyled mt-3 mb-4">
                        <h3 class="card-title pricing-card-title"><?= $article->getPrice(); ?>€ <small class="text-muted"></small></h3>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#article_<?= $article->getId(); ?>"> Voir plus</button>
                </div>
            </div>

        <?php }
        $this->viewArticle($article->getId());
        } ?>

    </div>
    <?= $paginationView; ?>
</div>