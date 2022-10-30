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
    
    $CE_P1;
    $CE_P2;
    $CE_P3;
    $CE_I1;
    $CE_I2;
    $CE_I3;
    $CE_U1;
    $CE_U2;
    $CE_U3;
    $CE_E;
    $CE_FP;
    $CE_FREQUENCE;
    $CE_P;
    $TRDate;
    $TRheure;

    $reponse = $bdd->query("SELECT CE_P1,CE_P2,CE_P3,CE_I1,CE_I2,CE_I3,CE_U1,CE_U2,CE_U3,CE_E,CE_FP,CE_FREQUENCE,CE_P,
    DATE_FORMAT(TRDate,'%d/%m/%Y') AS TRDate,TRheure FROM ce_tempsreel");

    while ($donnees = $reponse->fetch())
    {

        $CE_P1 = $donnees['CE_P1'];
        $CE_P2 = $donnees['CE_P2'];
        $CE_P3 = $donnees['CE_P3'];
        $CE_I1 = $donnees['CE_I1'];
        $CE_I2 = $donnees['CE_I2'];
        $CE_I3 = $donnees['CE_I3'];
        $CE_U1 = $donnees['CE_U1'];
        $CE_U2 = $donnees['CE_U2'];
        $CE_U3 = $donnees['CE_U3'];
        $CE_E =  $donnees['CE_E'];
        $CE_FP = $donnees['CE_FP'];
        $CE_FREQUENCE = $donnees['CE_FREQUENCE'];
        $CE_P = $donnees['CE_P']; 
        $TRDate = $donnees['TRDate'];
        $TRheure = $donnees['TRheure'];
        

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
        <style type="text/css">
        
        fieldset{
            border-radius: 16px;
        }
        legend {
            text-transform: capitalize;
            font-variant: small-caps;
            background: #FFF;			
            color: #4e73df !important;
            position: relative;
            font-size: 18px;
            border-radius: 5px;
        }
        select{
                border-radius: 5px;
                width : 20%;		       
            }
		 
        th {
            background: #4e73df;
            color:white;
        }



        </style>
        <title>Consommation Village</title>
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
                        <h1 class="mt-4">Consommation Village</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="layout-static - synoptiques.php">Synoptiques</a></li>
                            <li class="breadcrumb-item active">Consommation Village</li>
                            <li style="position:absolute;right:3%;font-size:1vw;" class="text-danger"> Dernière mise à jour : <?php echo $TRDate?> à <?php echo $TRheure?></li>
                        </ol>    
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  class="table  table-bordered" width="100%" cellspacing="0">
                                        <tr>
                                            <td width="45%">
                                                <fieldset>
                                                    <legend >Total</legend>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Energie</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_E ?>
                                                            </td>
                                                            <td align="center" >
                                                                kWh
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Fréquence</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_FREQUENCE ?>
                                                            </td>
                                                            <td align="center" >
                                                                Hz
                                                            </td>
                                                        </tr>	                           	
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Puissance</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_P?>
                                                            </td>
                                                            <td align="center" >
                                                                Kw
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </fieldset>
                                                <fieldset>
                                                    <legend >Secteur 3</legend>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Puissance</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_P3 ?>
                                                            </td>
                                                            <td align="center" >
                                                                Kw
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Courant</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_I3 ?>
                                                            </td>
                                                            <td align="center" >
                                                                A
                                                            </td>
                                                        </tr>	                           	
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Tension</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_U3 ?>
                                                            </td>
                                                            <td align="center" >
                                                                V
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </fieldset>
                                            </td>
                                            <td width="45%" >
                                                <fieldset>
                                                    <legend >Secteur 1</legend>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Puissance</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_P1 ?>
                                                            </td>
                                                            <td align="center" >
                                                                Kw
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Courant</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_I1 ?>
                                                            </td>
                                                            <td align="center" >
                                                                A
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Tension</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_U1 ?>
                                                            </td>
                                                            <td align="center" >
                                                                V
                                                            </td>
                                                        </tr>                            	
                                                    </table>
                                                </fieldset>
                                                <fieldset>
                                                    <legend >Secteur 2</legend>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Puissance</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_P2?>
                                                            </td>
                                                            <td align="center" >
                                                                Kw
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Courant</label>
                                                            </td>
                                                            <td align="center" width="300px">
                                                                <?php echo $CE_I2 ?>
                                                            </td>
                                                            <td align="center" >
                                                                A
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="text-danger">Tension</label>
                                                            </td>
                                                            <td align="center" width="20%">
                                                                <?php echo $CE_U2 ?>
                                                            </td>
                                                            <td align="center" >
                                                                V
                                                            </td>
                                                        </tr>                            	
                                                    </table>
                                                </fieldset>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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
        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
    </body>
</html>
