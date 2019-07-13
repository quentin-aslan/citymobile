<?php
/** @var TYPE_NAME $article */
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
            <div class="modal-body">
                <p style="text-align: center;"><img width="286" height="180" src="img/<?= $article->getPhoto(); ?>" alt="<?= $article->getName(); ?>"></p>
                <p>
                <ul>
                    <li>Type : <b><?= $article->getType(); ?></b></li>
                    <li>Marque : <b><?= $article->getMark(); ?></b></li>
                    <li>Prix: <b><?= $article->getPrice(); ?></b></li>
                </ul>
                </p>
                <?= $article->getDescription(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>