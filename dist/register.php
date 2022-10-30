<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="img/icon.png">
        <title>Création de compte</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Créer un compte</h3></div>
                                    <div class="card-body">
                                        <form action="../php/inscription.php" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="prenom">Prénom</label>
                                                        <input class="form-control py-4" id="prenom" name="prenom" type="text" placeholder="Entrer votre prénom" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="nom">Nom</label>
                                                        <input class="form-control py-4" id="nom" name="nom" type="text" placeholder="Entrer votre nom" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="username">Nom d'utilisateur</label>
                                                <input class="form-control py-4" id="username" name="username" type="text" aria-describedby="emailHelp" placeholder="Entrer votre nom d'utilisateur" required/>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="password">Mot de passe</label>
                                                        <input class="form-control py-4" id="password" name ="password" type="password" placeholder="Entrer votre password" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="passwordRepeat">Confirmez le mot de passe</label>
                                                        <input class="form-control py-4" id="passwordRepeat" name="passwordRepeat" type="password" placeholder="Confirmez le mot de passe" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><input type="submit" name="" class="btn btn-primary btn-block" value="Créer un compte"></div>
                                            <?php
                                                if(isset($_GET['erreur'])){

                                                    $err = $_GET['erreur'];
                                                    if($err==0){
                                                        echo "<p style='color:red;text-align: center;'>Mot de passe incorrect</p>";
                                                    }
                                                }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="pageLogin.php">Vous avez déjà un compte? Connectez-vous</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; CISIX Sarl 2020</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
