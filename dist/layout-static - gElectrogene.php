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
    
    $GEEtat_du_Moteur;
    $GETension_L1_N;
    $GEFrequence;
    $GECourant_Phase1;
    $GE_Heures;
    $GETemp_Moteur;
    $GETension_Batt;
    $GEVitesse_Moteur;
    $GEPression_Huile;
    $imageSecteur1 = "img/SynGEOff";
    $TRDate;
    $TRheure;

    $reponse = $bdd->query("SELECT GEEtat_du_Moteur,GETension_L1_N,GEFrequence,GECourant_Phase1,GE_Heures,
    GETemp_Moteur,GETension_Batt,GEVitesse_Moteur,GEPression_Huile,DATE_FORMAT(TRDate,'%d/%m/%Y') AS TRDate,TRheure FROM ge_tempsreel");

    while ($donnees = $reponse->fetch())
    {
        $GE_Heures = $donnees['GE_Heures'];
        $GETension_Batt = $donnees['GETension_Batt'];
        $GEEtat_du_Moteur = $donnees['GEEtat_du_Moteur'];
        $GETension_L1_N = $donnees['GETension_L1_N'];
        $GEFrequence = $donnees['GEFrequence'];
        $GECourant_Phase1 = $donnees['GECourant_Phase1'];
        $GETemp_Moteur = $donnees['GETemp_Moteur'];
        $GEVitesse_Moteur = $donnees['GEVitesse_Moteur'];
        $GEPression_Huile = $donnees['GEPression_Huile'];
        $TRDate = $donnees['TRDate'];
        $TRheure = $donnees['TRheure'];
        
    }

    if ($GEEtat_du_Moteur !=0) {
        # code...
        $imageSecteur1="img/SynGEOn";
    }


    $reponse->closeCursor(); 



    //les 10 dernier jours de la semaine
    setlocale(LC_TIME, 'fra_fra');
    $array= [];
    $day = 1 ;
    while($day <=10 ){

        $hier = new DateTime('-'.$day.' day', new DateTimeZone('Africa/Dakar'));
        $hierEnChiffre = $hier -> format('d/m').' ';
        $array [] = $hierEnChiffre;
        $day +=1;
        
    }
     

    $tableauSomme = [];
    $somme = 0;
    $day = 2 ;
    while($day <=11 ){

        $GE_HeuresBar1 = '';
        $GE_HeuresBar2 = '';
        
        $yesterday = new DateTime('-'.$day.' day', new DateTimeZone('Africa/Dakar'));
        $hierEnChiffre =  $yesterday -> format('Y-m-d');

        $reponse = $bdd->query("SELECT GE_Heures  FROM `rapport_journalier` where Dates_GE ='".$hierEnChiffre."'");

        while ($donnees = $reponse->fetch()){

            $GE_HeuresBar1 = $donnees['GE_Heures'];

        
        }
            
        $dayAvHiere = $day + 1;
        $avanthier = new DateTime('-'.$dayAvHiere.' day', new DateTimeZone('Africa/Dakar'));
        $dateAvantHier =  $avanthier -> format('Y-m-d');
        
        $reponse = $bdd->query("SELECT GE_Heures  FROM `rapport_journalier` where Dates_GE ='".$dateAvantHier."'");

            while ($donnees = $reponse->fetch())
        {

            $GE_HeuresBar2 = $donnees['GE_Heures'];
        
        }


        if ($GE_HeuresBar1 != null && $GE_HeuresBar2 != null) {
            # code...
            
            $GE_HeuresBar3 = ( ( floor($GE_HeuresBar1 * 100) - floor($GE_HeuresBar2 * 100) ) / 100 );
            //si la valeur est negatif 
            if ($GE_HeuresBar3<0) {
                # code...
                $GE_HeuresBar3 = 0;
            }
            $tableauSomme [] = $GE_HeuresBar3;
        }
        else {
            # code...
            $tableauSomme [] = 0;
        }
        
            $day +=1;
            
    }

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
        <title>Groupe Electrogène</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style type="text/css">

            
            .absolu{position: absolute;}
            
            .haut1{top: 8%;}
            .droite1{right: 15%;}


            .haut2{top:26%}
            .droite2{right: 17%;}

            .haut3{top:45%}
            .droite3{right: 47%;}

            .haut4{top:51%}
            .droite4{right: 47%;}

            .haut5{top:57.5%}
            .droite5{right: 47%;}

            .haut6{top:63.5%}
            .droite6{right: 47%;}

            .haut7{top:70%}
            .droite7{right: 47%;}
            
            .haut8{top:76.5%}
            .droite8{right: 47%;}

            .haut9{top:45%}
            .droite9{right: 18%;}
            
        </style>
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
                        <h1 class="mt-4">Groupe Electrogène</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="layout-static - synoptiques.php">Synoptiques</a></li>
                            <li class="breadcrumb-item active">Groupe Electrogène</li>
                            <li style="position:absolute;right:3%;font-size:1vw;" class="text-danger"> Dernière mise à jour : <?php echo $TRDate?> à <?php echo $TRheure?></li>
                        </ol>    
                        <div class="card mb-4  bg-light mt-auto">                       
                            <img src="<?php echo $imageSecteur1?>.png" style="margin: auto;width:90%;">                             
                            <p class="font-weight-bold absolu haut1 droite1" style="font-size:1vw;" ><?php echo $GE_Heures?></p>
                            
                            <p class="font-weight-bold absolu haut2 droite2" style="font-size:1vw;"><?php echo $GETension_Batt.' V'?></p>
                            
                            <p class="font-weight-bold absolu haut3 droite3 " style="font-size:1vw;"><?php echo $GETension_L1_N.' V'?></p>
                            
                            <p class="font-weight-bold absolu haut4 droite4 " style="font-size:1vw;"><?php echo $GEFrequence.' Hz'?></p>
                            
                            <p class="font-weight-bold absolu haut5 droite5 " style="font-size:1vw;"><?php echo $GECourant_Phase1.' A'?></p>
                            
                            <p class="font-weight-bold absolu haut6 droite6 " style="font-size:1vw;"><?php echo $GETemp_Moteur.' °C'?></p>
                            
                            <p class="font-weight-bold absolu haut7 droite7 " style="font-size:1vw;"><?php echo $GEVitesse_Moteur.' RPM'?></p>
                            
                            <p class="font-weight-bold absolu haut8 droite8 " style="font-size:1vw;"><?php echo $GEPression_Huile.' kPa'?></p>
                        </div>
                        <div class="card mb-4">
                            <div class="card"style="width:100%;">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Heures de fonctionnement du GE
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%"></canvas></div>
                            </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <!-- diagramme en barre-->
        <script>
			var ctx = document.getElementById('myBarChart').getContext('2d');
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					labels: <?php echo json_encode($array);?>,
					datasets: [{
						label: 'La consommation quotidienne( 10 jours)',
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        borderWidth: 1,
                        data: <?php 
                      
                        // probleme de floa avec jso encode
                        ini_set('serialize_precision', 14); 
                        ini_set('precision', 14);

                         echo json_encode($tableauSomme) ;?>
					}]
				},

				// Configuration options go here
				options: {
                    legend: {
                        display: false,
                        labels: {
                            fontColor: 'rgb(255, 99, 132)'
                        }
                    },
                    animation: {
                        duration: 500,
                        easing: "easeOutQuart",
                        onComplete: function () {
                            var ctx = this.chart.ctx;
                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset) {
                                for (var i = 0; i < dataset.data.length; i++) {
                                    var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                        scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                    ctx.fillStyle = '#444';
                                    var y_pos = model.y - 5;
                                    // Make sure data value does not get overflown and hidden
                                    // when the bar's value is too close to max value of scale
                                    // Note: The y value is reverse, it counts from top down
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20; 
                                    ctx.fillText(dataset.data[i], model.x, y_pos);
                                }
                            });               
                        }
                    }
                }
			});

		</script>
        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
    </body>
</html>
