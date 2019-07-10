<div class="container">

    <center>
        <h2>
            <a href="index.php?p=admin_add_article" class="btn btn-success">Ajouter un nouvelle article</a>
            <a href="index.php?p=list_articles" class="btn btn-primary">Liste des articles vu par les clients</a>
        </h2>
    </center>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Type</th>
            <th scope="col">Marque</th>
            <th scope="col">Prix</th>
            <th scope="col">Date de mise en vente</th>
            <th>Gerer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \citymobile\Article $article */
        foreach ($articles as $article) {
        ?>
        <tr>
            <th scope="row"><?= $article->getName() ?></th>
            <td><?= $article->getType(); ?></td>
            <td><?= $article->getMark(); ?></td>
            <td><?= $article->getPrice(); ?></td>
            <td><?= $article->getDateCreate(); ?></td>
            <td>
                <a href="index.php?p=admin_update_article&token=<?= $article->getId(); ?>" class="btn btn-warning">Modifier</a>
                <a href="index.php?p=admin_update_article&token=<?= $article->getId(); ?>" class="btn btn-danger">Supprimer</a>
                <!-- <form action="index.php?p=admin_delete_article" method="post"><input type="text" class="btn btn-danger" value="supprimer" /></form> -->
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>