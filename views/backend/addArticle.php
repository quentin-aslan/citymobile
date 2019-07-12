<div class="container">


    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger" role="alert">Vous devez remplir les champs du formulaire (La photo comprise)<br /> </div>';
    } ?>

    <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">

            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Ajout d'un article</h4>
            </div>
            <center>
                <div class="card-body">
                    <form method="POST" action="index.php?p=admin_add_article" enctype="multipart/form-data"
                          class="col-lg-7">

                        <div class="form-group">
                            <label for="name">Nom de l'article :</label>
                            <input type="text" class="form-control" name="name" placeholder="Iphone X">
                        </div>

                        <div class="form-group">
                            <label for="price">Prix : (Juste le chiffre)</label>
                            <input type="prix" class="form-control" name="price" placeholder="459,99">
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
                            <input type="text" class="form-control" name="mark" placeholder="Apple">
                        </div>

                        <div class="form-group">
                            <label for="photo">Ajoutez une photo de l'article : </label>
                            <input type="file" class="form-control-file" name="photo">
                        </div>

                        <div class="form-group alert alert-warning">
                            <label for="prix">Description du produit :</label>
                            <div style="font-weight: bold">Capacité de stockage, RAM, Taille
                                d'écran, Double Sim, Qualité de l'appareil photo.</div>
                                <textarea rows="5" name="description" class="form-control">
Capacité de stockage : XXGo
Dimension : XX</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </center>

            <small class="form-text text-muted hidden-xs">Formulaire optimisé pour l'interface sur IOS.</small>

        </div>
    </div>
</div> <!-- Fin container -->