<?php 
    session_start();
    include("../php/bdd.php");

            //si les deux variables n'ont pas été créées
	if (!isset($_SESSION['idUser']) && !isset($_SESSION['username']) && !isset($_SESSION['profilUser'])
    && !isset($_SESSION['nomUser']) && !isset($_SESSION['prenomUser']))
    {

      // Redirection du visiteur vers la page du login 
      header('Location: ../index.html');
       
    }
    
    $Secteur_1;
    $Secteur_2;
    $Secteur_3;
    $GEEtat_du_Moteur;
    $TRDateCe_tempsreel;
    $TRheureCe_tempsreel;
    $TRDateGe_tempsreel;
    $TRheureGe_tempsreel;
    $TRDate;
    $TRheure;
    $TRDateMeteo_tempsreel;
    $TRheureMeteo_tempsreel;
    
    
    $reponse = $bdd->query("SELECT Secteur_1,Secteur_2,Secteur_3, TRDate,TRheure FROM ce_tempsreel");

    while ($donnees = $reponse->fetch())
    {

        $Secteur_1 = $donnees['Secteur_1'];
        $Secteur_2 = $donnees['Secteur_2'];
        $Secteur_3 = $donnees['Secteur_3'];
        $TRDateCe_tempsreel = $donnees['TRDate'];
        $TRheureCe_tempsreel = $donnees['TRheure'];
        

    }

    $reponse = $bdd->query("SELECT GEEtat_du_Moteur,TRDate,TRheure FROM ge_tempsreel");

    while ($donnees = $reponse->fetch())
    {

        $GEEtat_du_Moteur = $donnees['GEEtat_du_Moteur'];
        $TRDateGe_tempsreel = $donnees['TRDate'];
        $TRheureGe_tempsreel = $donnees['TRheure'];

    }

    $reponse = $bdd->query("SELECT  TRDate,TRheure FROM meteo_tempsreel");

    while ($donnees = $reponse->fetch())
    {

        $TRDateMeteo_tempsreel = $donnees['TRDate'];
        $TRheureMeteo_tempsreel = $donnees['TRheure'];
        

    }
    
   /* setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            

    $tmstp1 = strtotime($TRDateMeteo_tempsreel);
    $tmstp2 = strtotime($TRDateGe_tempsreel);
    $tmstp3 = strtotime($TRDateCe_tempsreel);
    
    $dfr1 = strftime('%A %d %B %Y', $tmstp1);
    $dfr2 = strftime('%A %d %B %Y', $tmstp2);
    $dfr3 = strftime('%A %d %B %Y', $tmstp3);
    
    if($tmstp1 < $tmstp2 && $tmstp2< $tmstp3){
        $TRDate = $tmstp3;
    }elseif($tmstp1 == $tmstp2){
        echo 'Les deux dates sont les mêmes';
    }else{
         echo 'Le ' .$dfr2. ' est avant le ' .$dfr1;
    }
                setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            
            $d1 = '25-01-2019';
            $d2 = '30-June 2018';
            $tmstp1 = strtotime($d1);
            $tmstp2 = strtotime($d2);
    
*/  
    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
    $TRDateMeteo = strtotime($TRDateMeteo_tempsreel);
    $TRDateGe = strtotime($TRDateGe_tempsreel);
    $TRDateCe = strtotime($TRDateCe_tempsreel);
    
    $TRDateMeteo_tempsreel = strftime('%d/%m/%Y',strtotime($TRDateMeteo_tempsreel));
    $TRDateGe_tempsreel = strftime('%d/%m/%Y',strtotime($TRDateGe_tempsreel));
    $TRDateCe_tempsreel = strftime('%d/%m/%Y',strtotime($TRDateCe_tempsreel));

    if ($TRDateMeteo==$TRDateGe && $TRDateMeteo==$TRDateCe) {
        # code...
        $TRDate = $TRDateMeteo_tempsreel;
        if ($TRheureMeteo_tempsreel>= $TRheureGe_tempsreel && $TRheureMeteo_tempsreel>=$TRheureCe_tempsreel) {
            # code...
            $TRheure = $TRheureMeteo_tempsreel;
        }
        elseif($TRheureGe_tempsreel>= $TRheureMeteo_tempsreel && $TRheureGe_tempsreel>=$TRheureCe_tempsreel){
            $TRheure = $TRheureGe_tempsreel;
        }
        elseif($TRheureCe_tempsreel>= $TRheureMeteo_tempsreel && $TRheureCe_tempsreel>=$TRheureGe_tempsreel){
            $TRheure = $TRheureCe_tempsreel;
        }

    }
    elseif($TRDateMeteo>$TRDateGe && $TRDateMeteo>$TRDateCe) {
        # code...
        $TRDate = $TRDateMeteo_tempsreel;
        $TRheure = $TRheureMeteo_tempsreel;

    }
    elseif($TRDateGe>$TRDateMeteo && $TRDateGe>$TRDateCe) {
        # code...
        $TRDate = $TRDateGe_tempsreel;
        $TRheure = $TRheureGe_tempsreel;

    }
    elseif($TRDateCe>$TRDateMeteo && $TRDateCe>$TRDateGe) {
        # code...1617228000
        #1609714800
        $TRDate = $TRDateCe_tempsreel;
        $TRheure = $TRheureCe_tempsreel;

    }
    elseif($TRDateCe==$TRDateMeteo && $TRDateCe>$TRDateGe) {
        # code...1617228000
        #1609714800
        $TRDate = $TRDateCe_tempsreel;
        if ($TRheureCe_tempsreel >= $TRheureMeteo_tempsreel) {
            # code...
            $TRheure = $TRheureCe_tempsreel;
        }
        else {
            $TRheure = $TRheureMeteo_tempsreel;
        } 

    }
    elseif($TRDateCe>$TRDateMeteo && $TRDateCe==$TRDateGe) {
        # code...1617228000
        #1609714800
        $TRDate = $TRDateCe_tempsreel;
        if ($TRheureCe_tempsreel >= $TRDateGe_tempsreel) {
            # code...
            $TRheure = $TRheureCe_tempsreel;
        }
        else {
            $TRheure = $TRDateGe_tempsreel;
        } 

    }
    elseif($TRDateMeteo>$TRDateCe && $TRDateMeteo==$TRDateGe) {
        # code...1617228000
        #1609714800
        $TRDate = $TRDateGe_tempsreel;
        if ($TRheureMeteo_tempsreel >= $TRDateGe_tempsreel) {
            # code...
            $TRheure = $TRheureMeteo_tempsreel;
        }
        else {
            $TRheure = $TRDateGe_tempsreel;
        } 

    }


    if ($Secteur_1 ==0 && $Secteur_2 ==0 && $Secteur_3 ==0 && $GEEtat_du_Moteur ==0) {
        # code...
        //all off
        $image="img/SynSyntheseAllOff";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==1 && $Secteur_3 ==1 && $GEEtat_du_Moteur != 0) {
        //all on
        # code...
        $image="img/SynSyntheseAllOn";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==0 && $Secteur_3 ==0 && $GEEtat_du_Moteur == 0) {
        //s1 on
        # code...
        $image="img/SynSyntheseS1On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==1 && $Secteur_3 ==0 && $GEEtat_du_Moteur == 0) {
        //s2 on
        # code...
        $image="img/SynSyntheseS2On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==0 && $Secteur_3 ==1 && $GEEtat_du_Moteur == 0) {
        //S3 on
        # code...
        $image="img/SynSyntheseS3On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==0 && $Secteur_3 ==0 && $GEEtat_du_Moteur != 0) {
        //GE on
        # code...
        $image="img/SynSyntheseGeOn";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==1 && $Secteur_3 ==0 && $GEEtat_du_Moteur == 0) {
        //S12 on
        # code...
        $image="img/SynSyntheseS1S2On";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==0 && $Secteur_3 ==1 && $GEEtat_du_Moteur == 0) {
        //S13 on
        # code...
        $image="img/SynSyntheseS1S3On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==1 && $Secteur_3 ==1 && $GEEtat_du_Moteur == 0) {
        //S23 on
        # code...
        $image="img/SynSyntheseS2S3On";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==0 && $Secteur_3 ==0 && $GEEtat_du_Moteur != 0) {
        //GES1 on
        # code...
        $image="img/SynSyntheseGeS1On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==1 && $Secteur_3 ==0 && $GEEtat_du_Moteur != 0) {
        //GES2 on
        # code...
        $image="img/SynSyntheseGeS2On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==0 && $Secteur_3 ==1 && $GEEtat_du_Moteur != 0) {
        //GES2 on
        # code...
        $image="img/SynSyntheseGeS3On";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==1 && $Secteur_3 ==1 && $GEEtat_du_Moteur == 0) {
        //s123 on
        # code...
        $image="img/SynSyntheseS123On";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==1 && $Secteur_3 ==0 && $GEEtat_du_Moteur != 0) {
        //s123 on
        # code...
        $image="img/SynSyntheseGeS1S2On";
    }
    elseif ($Secteur_1 ==1 && $Secteur_2 ==0 && $Secteur_3 ==1 && $GEEtat_du_Moteur != 0) {
        //s123 on
        # code...
        $image="img/SynSyntheseGeS1S3On";
    }
    elseif ($Secteur_1 ==0 && $Secteur_2 ==1 && $Secteur_3 ==1 && $GEEtat_du_Moteur != 0) {
        //s123 on
        # code...
        $image="img/SynSyntheseGeS2S3On";
    }


    $reponse->closeCursor();

?>      
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="img/icon.png">
        <title>Synoptiques</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>


    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">LinkOn Monitoring</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Paramètres</a>
                        <a class="dropdown-item" href="#">Journal d'activité</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Se déconnecter</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Base</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-archway"></i></div>
                                Tableau de bord
                            </a>
                            <a class="nav-link collapsed" href="layout-static-indicateurs-de-performance.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Indicateurs de Performance
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Vues
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static - synoptiques.php">Synthèse</a>
                                    <a class="nav-link" href="layout-static-consommation-village.php">Centrale d'énergie</a>
                                    <a class="nav-link" href="">Onduleurs</a>
                                    <a class="nav-link" href="layout-static - gElectrogene.php">Groupe électrogène</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="pageLogin.php">Login</a>
                                            <a class="nav-link" href="register.php">S'inscrire</a>
                                            <a class="nav-link" href="password.html">Mot de passe oublié</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Graphiques
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tableaux
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que:</div>
                        <?php echo $_SESSION['profilUser']?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Synoptiques</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Synoptiques</li>
                            <li style="position:absolute;right:3%;font-size:1vw;" class="text-danger"> Dernière mise à jour : <?php echo $TRDate?> à <?php echo $TRheure?></li>
                       </ol>
                        <div class="row d-flex justify-content-between">
                            <div class=" col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static-consommation-village.php"  class="btn btn-outline-primary btn-sm " style="width:70%;height:100%;">Consommation Village</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static - gElectrogene.php" class="btn btn-outline-danger btn-sm" style="width:70%;height:100%;">Groupe Electrogène</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href=""  class="btn btn-outline-secondary btn-sm" style="width:70%;height:100%;">Onduleurs</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static - Station- Météo.php"  class="btn btn-outline-success btn-sm" style="width:70%;height:100%;">Station Météo</a>
                                </div>
                            </div>
                        </div>    
                        <div class="card mb-4 bg-light mt-auto" >
                            <img src="<?php echo $image?>.png" style="margin: auto;width:90%;">
                        </div>
                    </div>    
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; CISIX Sarl 2020</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Logout Modal-->
        <?php
            include("../logoutModal.html"); 
        ?>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
    </body>
</html>
