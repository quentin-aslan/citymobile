<div class="container">

    <center>
        <h2>
            <a href="index.php?p=admin_add_article" class="btn btn-success">Ajouter un nouvelle article</a>
            <!-- <a href="index.php?p=list_articles" class="btn btn-primary">Liste des articles vu par les clients <em>(Avec
                    photos)</em></a> -->
        </h2>
    </center>
        <div class="card-deck col-lg-12 text-center">
        <?php
        /** @var \citymobile\Article $article */
        $i = 0;
        foreach ($articles as $article) {
        $color = rand(1,2);
        switch ($color) {
            case '1':
                $color = 'danger';
                break;
            case '2':
                $color = 'info';
                break;
        }
        if ($i == 4){
        ?>

        <div class="card text-white bg-<?= $color; ?> mb-3" style="max-width: 18rem;">
            <div class="card-header"><?= $article->getName(); ?></div>
            <div class="card-body">
                <p class="card-tex text-left">
                    Type : <strong><?= $article->getType(); ?></strong>
                    <br>
                    Prix : <strong><?= $article->getPrice(); ?></strong>
                    <br>
                    Marque : <strong><?= $article->getMark(); ?></strong>
                    <br>
                <p><button type="button" class="btn btn-block btn-light"" data-toggle="modal" data-target="#article_<?= $article->getId(); ?>"> Voir plus</button></p>
                </p>

            </div>
        </div>
</div>
<div class="card-deck col-lg-12 text-center">

    <?php
    $i = 0;
    } else {
        $i++;
        ?>
        <div class="card text-white bg-<?= $color; ?> mb-3" style="max-width: 18rem;">
            <div class="card-header"><?= $article->getName(); ?></div>
            <div class="card-body">
                <p class="card-tex text-left">
                    Type : <strong><?= $article->getType(); ?></strong>
                    <br>
                    Prix : <strong><?= $article->getPrice(); ?></strong>
                    <br>
                    Marque : <strong><?= $article->getMark(); ?></strong>
                    <br>
                <p><button type="button" class="btn btn-block btn-light"" data-toggle="modal" data-target="#article_<?= $article->getId(); ?>"> Voir plus</button></p>
                </p>

            </div>
        </div>

    <?php
        }
        $this->viewArticle($article->getId());
    }
        ?>
    <?= $paginationView; ?>

</div>
