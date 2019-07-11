<div class="container">


    <?php
    /** @var \citymobile\Article $article */
    if(!empty($errors)) {
        echo'<div class="alert alert-danger" role="alert">Vous devez remplir les champs du formulaire (La photo comprise)<br /> </div>';
    }?>

    <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">

            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Modification de l'article <em>"<?= $article->getName(); ?>"</em></h4>
            </div>
            <center>
                <div class="card-body">
                    <form method="POST" action="index.php?p=admin_update_article&token=<?= $article->getId(); ?>" enctype="multipart/form-data" class="col-lg-7">

                        <div class="form-group">
                            <label for="name">Nom de l'article :</label>
                            <input type="text" class="form-control" name="name" placeholder="Iphone X" value="<?= $article->getName(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="price">Prix : (Juste le chiffre)</label>
                            <input type="prix" class="form-control" name="price" placeholder="459,99" value="<?= $article->getPrice(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type">
                                <option>Telephones</option>
                                <option>Accessoires</option>
                                <option>Tablette</option>
                                <!-- <option>Pour ajouter des "Type" contacter le développeur (quentin.aslan@outlook.com)</option> -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mark">Marque :</label>
                            <input type="text" class="form-control" name="mark" placeholder="Apple" value="<?= $article->getMark(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="photo">Modifier la photo de l'article : </label>
                            <div class="alert alert-danger">
                                Si vous laissez ce champs vide, la photo ne sera pas modifié, à l'inverse si vous remplissez ce champs l'ancienne sera automatiquement supprimé.
                                <br />
                                <strong>Photo actuel :</strong>
                                <br />
                                <img width="286" height="100" src="img/<?= $article->getPhoto(); ?>" alt="<?= $article->getName(); ?>">
                            </div>
                            <input type="file" class="form-control-file" name="photo" >
                            <input type="hidden" name="oldPhoto" value="<?= $article->getPhoto(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="prix">Description du produit :</label>
                            <textarea name="description" class="form-control"><?= $article->getDescription(); ?></textarea>
                        </div>

                        <input type="hidden" name="id" value="<?= $article->getId(); ?>">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </center>

            <small class="form-text text-muted hidden-xs">Formulaire optimisé pour l'interface sur IOS.</small>

        </div>
    </div>
</div> <!-- Fin container -->