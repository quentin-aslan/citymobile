<?php
/** @var \citymobile\Article $article */
?>

<!-- Modal VIEW -->
<div class="modal fade" id="article_<?= $article->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="article_<?= $article->getId(); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= $article->getName(); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <p style="text-align: center;"><img width="286" height="180" src="img/articles/<?= $article->getPhoto(); ?>" alt="<?= $article->getName(); ?>"></p>
                <ul class="list-group">
                    <li class="list-group-item">Type : <b><?= $article->getType(); ?></b></li>
                    <li class="list-group-item">Marque : <b><?= $article->getMark(); ?></b></li>
                    <li class="list-group-item">Prix: <b><?= $article->getPrice(); ?>€</b></li>
                    <li class="list-group-item"><?= $article->getDescription(); ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                    <a href="index.php?p=admin_update_article&token=<?= $article->getId(); ?>"
                       class="btn btn-warning">Modifier</a></p>
                    <a href="index.php?p=admin_delete_article&token=<?= $article->getId(); ?>" class="btn btn-danger text-white"
                       onclick="return confirm('Voulez-vous vraiment supprimer l\'article : <?= $article->getName(); ?>');">Supprimer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>