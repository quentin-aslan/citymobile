<div class="container">

    <?php
    if(!empty($errors)) {
        if ($errors==\citymobile\AdministratorManager::ERROR_CONNECT) {
            echo '<div class="alert alert-danger" role="alert">Vous avez entré de mauvais identifiants</div>';
        }else{
            echo'<div class="alert alert-danger" role="alert">Vous devez remplir les champs du formulaire</div>';
        }
    }?>

    <div class="card-deck mb-3 text-center">
        <center class="card mb-4 box-shadow">

            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Connexion à l'administration</h4>
            </div>

            <center>
                <div class="card-body">
                    <form method="POST" action="index.php?p=admin_login" class="col-lg-7">
                        <div class="form-group">
                            <label for="username">Pseudo : </label>
                            <input type="text" class="form-control" id="pseudo" name="username" placeholder="Entrer le pseudo">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrer le mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </form>
                </div>
            </center>

            <small class="form-text text-muted">Partie reservé a l'administration, si vous avez oublié les identifiants <a href="http://linkedin.com/in/quentin-aslan">contacter le développeur.</a></small>

        </div>
    </div>
</div> <!-- Fin container -->