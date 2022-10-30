<?php

session_start();
include("../php/bdd.php");

//si les deux variables n'ont pas été créées
if (
    !isset($_SESSION['idUser']) && !isset($_SESSION['username']) && !isset($_SESSION['profilUser'])
    && !isset($_SESSION['nomUser']) && !isset($_SESSION['prenomUser'])
) {

    // Redirection du visiteur vers la page du login 
    header('Location: ../index.html');
}
//23R@bichr@khli1234
//je me connecte à la base de donnees linkonprojet
$con = mysqli_connect('localhost', 'root', '', 'linkonprojet');


//tableau consommation quotidienne
//les 10 dernier jours de la semaine
setlocale(LC_TIME, 'fra_fra');
$array = [];
$day = 1;
while ($day <= 10) {
    $hier = new DateTime('-' . $day . ' day', new DateTimeZone('Africa/Dakar'));
    $hierEnChiffre = $hier->format('d/m') . ' ';
    $array[] = $hierEnChiffre;
    $day += 1;
}

//faire la somme des consommations

$tableauSomme = [];
$somme = 0;
$day = 1;
while ($day <= 10) {

    $yesterday = new DateTime('-' . $day . ' day', new DateTimeZone('Africa/Dakar'));
    $hierEnChiffre =  $yesterday->format('Y-m-d');
    $sql = "SELECT consommation_actuelle  FROM `rapport_journalier` where date ='" . $hierEnChiffre . "'";
    $fire = mysqli_query($con, $sql);
    while ($result = mysqli_fetch_assoc($fire)) {

        $cons = $result['consommation_actuelle'];
        if ($cons == 'N/A') {
        } else {

            $cons = (float) $cons;
            $somme += $cons;
        }
    }

    $tableauSomme[] = $somme;

    $somme = 0;
    $day += 1;
}


//je me connecte à la base de donnees
$con = mysqli_connect($_SESSION['host'], $_SESSION['root'], $_SESSION['pwd'], $_SESSION['DB']);

//diagramme en ligne
$tableauCE_Energie_Active = [];
$day = 2;
while ($day <= 11) {
    //initialiser les valeurs
    $CE_Energie_Active1 = '';
    $CE_Energie_Active2 = '';
    //recuperer la date d'hier
    $yesterday2 = new DateTime('-' . $day . ' day', new DateTimeZone('Africa/Dakar'));
    $hierEnChiffre2 =  $yesterday2->format('Y-m-d');
    $reponse = $bdd->query("SELECT CE_Energie_Active  FROM `rapport_journalier` where Dates_GE ='" . $hierEnChiffre2 . "'");
    //recuperer $CE_Energie_Active1 
    while ($donnees = $reponse->fetch()) {

        $CE_Energie_Active1  =  $donnees['CE_Energie_Active'];
    }
    //recuperer la date avant hier
    $dayAvHiere = $day + 1;
    $avanthier = new DateTime('-' . $dayAvHiere . ' day', new DateTimeZone('Africa/Dakar'));
    $dateAvantHier =  $avanthier->format('Y-m-d');
    $reponse = $bdd->query("SELECT CE_Energie_Active  FROM `rapport_journalier` where Dates_GE ='" . $dateAvantHier . "'");

    while ($donnees = $reponse->fetch()) {

        $CE_Energie_Active2 = $donnees['CE_Energie_Active'];
    }


    if ($CE_Energie_Active1 != null && $CE_Energie_Active2 != null) {
        # code...

        $CE_Energie_Active3 = ((floor($CE_Energie_Active1 * 100) - floor($CE_Energie_Active2 * 100)) / 100);
        $tableauCE_Energie_Active[] = $CE_Energie_Active3;
    } else {
        # code...
        $tableauCE_Energie_Active[] = 0;
    }

    $day += 1;
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
    <title>Accueil</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">LinkOn Monitoring</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2" />
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
                    <?php echo $_SESSION['profilUser'] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Tableau de bord</h1>
                    <ol class="breadcrumb mb-4">
                        <li>
                            Opérateur
                        </li>
                        <li class="breadcrumb-item active">
                            <div class="col-md-2">
                                <select name="sommeCons" id="sommeCons" style="width:150px;height:25px">
                                    <option value="Par_date">ENERSA</option>
                                </select>
                            </div>
                        </li>
                        <li class=" ">
                            Site
                        </li>
                        <li>
                            <div class="col-md-2">
                                <select name="sommeCons" id="sommeCons" style="width:150px;height:25px">
                                    <option value="Par_date">Ndombil</option>
                                </select>
                            </div>
                        </li>
                        <li class="breadcrumb-item active">

                            <a class="btn-secondary" href="" style='width:80px;height:25px; text-decoration:center'>
                                <center>OK</center>
                            </a>
                        </li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Synoptiques</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="layout-static - synoptiques.php">Voir Détails</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Alarmes</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Voir Détails</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Consignations</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Voir Détails</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Historiques</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="layout-static-Historiques-Conso-Village.php">Voir Détails</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area mr-1"></i>
                                    Production (kWh)
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Consommation (kWh)
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Evénements
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Date d'apparition</th>
                                            <th>Heure</th>
                                            <th>Statut</th>
                                            <th>Commentaire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <!-- graphe ligne-->
    <script>
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($array); ?>,
                datasets: [{
                    label: 'La consommation quotidienne( 10 jours)',
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: <?php

                            // probleme de floa avec jso encode
                            ini_set('serialize_precision', 14);
                            ini_set('precision', 14);

                            echo json_encode($tableauCE_Energie_Active); ?>
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
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                ctx.fillStyle = '#444';
                                var y_pos = model.y - 5;
                                // Make sure data value does not get overflown and hidden
                                // when the bar's value is too close to max value of scale
                                // Note: The y value is reverse, it counts from top down

                                //si la valeur est egalà zero on met N/A
                                if (dataset.data[i] == 0) {
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText('N/A', model.x, y_pos);
                                } else {

                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText(dataset.data[i], model.x, y_pos);

                                }

                            }
                        });
                    }
                }
            }
        });
    </script>

    <!-- diagramme en barre-->
    <script>
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($array); ?>,
                datasets: [{
                    label: 'La consommation quotidienne( 10 jours)',
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    borderWidth: 1,
                    data: <?php

                            // probleme de floa avec jso encode
                            ini_set('serialize_precision', 14);
                            ini_set('precision', 14);

                            echo json_encode($tableauSomme); ?>
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
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                ctx.fillStyle = '#444';
                                var y_pos = model.y - 5;
                                // Make sure data value does not get overflown and hidden
                                // when the bar's value is too close to max value of scale
                                // Note: The y value is reverse, it counts from top down

                                //si la valeur est egalà zero on met N/A
                                if (dataset.data[i] == 0) {
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText('N/A', model.x, y_pos);
                                } else {

                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText(dataset.data[i], model.x, y_pos);

                                }

                            }
                        });
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="../scripts/datatables.js" crossorigin="anonymous"></script>
    <!-- Momentjs pour la date format dd/mm//aa-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js" type="text/javascript"></script>
    <script>
        setTimeout("window.location='../logout.php'", 900000);
    </script>
    <!--scripts pour le tableau-->
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            var id_client, option;
            option = 1;

            var example = $('#example').DataTable({
                "ajax": {
                    "url": "../php/crud.php",
                    "method": 'POST', //nous utilisons la méthode POST
                    "data": {
                        option: option
                    }, //nous avons envoyé l’option 4 pour faire un SELECT
                    "dataSrc": ""
                },
                // buttons
                "dom": "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                        extend: 'print',
                        text: 'imprimer',
                        key: {
                            key: 'p',
                            altkey: true
                        }
                    },
                    {
                        extend: 'copy',
                        text: 'Copie',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        },
                    },
                    "excel", "pdf", 'csv'

                ],

                // responsive
                "responsive": true,
                "columns": [{
                        "data": "idEvenement"
                    },
                    {
                        "data": "typeEvenement"
                    },
                    {
                        "data": "descriptionEvenement"
                    },
                    {
                        "data": "dateDapparition",
                        render: $.fn.dataTable.render.moment('DD-MM-YYYY')
                    },
                    {
                        "data": "heureDapparition"
                    },
                    {
                        "data": "statutEvenement"
                    },
                    {
                        "data": "commentaireEvenement"
                    },
                ],
                "order": [
                    [0, 'desc']
                ]
            });

        });
    </script>

</body>

</html>