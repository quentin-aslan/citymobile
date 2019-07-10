<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">City Mobile</h1>
        <p class="lead">Site en développement</p>
        <adresse class="text-danger">Adresse : 19 rue du Pré Saint Gervais - 93500 Pantin</adresse>
    </div>
</div>


<div class="container">


    <?php
    if(isset($_GET['erreur'])) {
        $erreur = $_GET['erreur'];
        if ($erreur=='erreur_photo') {
            echo '<div class="alert alert-danger" role="alert">L\'envoie de la photo à provoquer une erreur, vérifier que c\'est bien une image.</div>';
        }else{
            echo'<div class="alert alert-danger" role="alert">Vous devez remplir les champs du formulaire</div>';
        }
    }?>

    <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">

            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Ajout d'un article</h4>
            </div>
            <center>
                <div class="card-body">
                    <form method="POST" action="index.php?p=add_article" enctype="multipart/form-data" class="col-lg-7">

                        <div class="form-group">
                            <label for="name">Nom de l'article :</label>
                            <input type="text" class="form-control" name="name" placeholder="Iphone 7">
                        </div>

                        <div class="form-group">
                            <label for="price">Prix : (Juste le chiffre)</label>
                            <input type="prix" class="form-control" name="price" placeholder="459,99">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Type</label>
                            <select class="form-control" name="type">
                                <option>Telephones</option>
                                <option>Accessoires</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mark">Marque :</label>
                            <input type="text" class="form-control" name="mark" placeholder="Iphone">
                        </div>

                        <div class="form-group">
                            <label for="photo">Ajoutez une photo du produit : </label>
                            <input type="file" class="form-control-file" name="photo">
                        </div>

                        <div class="form-group">
                            <label for="prix">Description du produit :</label>
                            <textarea name="description" class="form-control" m></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </center>

            <small class="form-text text-muted hidden-xs">Formulaire optimisé pour l'interface sur IOS.</small>

        </div>
    </div>
</div> <!-- Fin container -->