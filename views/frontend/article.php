<div class="card-deck col-lg-12 d-sm-none d-lg-flex text-center">
<?php
foreach ($articles as $article) {
    /** @var \citymobile\Article $article */
    ?>
    <div class="card col-lg-3 col-md-12 shadow-sm">
        <img class="card-img-top" width="286" height="180" src="img/articles/<?= $article->getPhoto(); ?>"
             alt="<?= $article->getName(); ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $article->getName(); ?></h5>
            <ul class="list-unstyled mt-3 mb-4">
                <h3 class="card-title pricing-card-title"><?= $article->getPrice(); ?>€
                    <small class="text-muted"></small>
                </h3>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary"
            " data-toggle="modal" data-target="#article_<?= $article->getId(); ?>"> Voir plus</button>
        </div>
    </div>
    <?php
    $this->viewModalArticle($article);
} ?>
</div>