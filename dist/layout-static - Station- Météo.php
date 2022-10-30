<?php 
    session_start();
    include("../php/bdd.php");

        //si les deux variables n'ont pas été créées
	if (!isset($_SESSION['idUser']) && !isset($_SESSION['username']) && !isset($_SESSION['profilUser'])&& !isset($_SESSION['nomUser']) && !isset($_SESSION['prenomUser']))
{

      // Redirection du visiteur vers la page du login 
      header('Location: ../index.html');
       
    }

    $Meteo_Temp;
    $Meteo_Hum;
    $Meteo_Light;
    $GEEtat_du_Moteur;
    $TRDate;
    $TRheure;

    $reponse = $bdd->query("SELECT Meteo_Temp,Meteo_Hum,Meteo_Light,DATE_FORMAT(TRDate,'%d/%m/%Y') AS TRDate,TRheure FROM meteo_tempsreel");

    while ($donnees = $reponse->fetch()){
        $Meteo_Temp = $donnees['Meteo_Temp'];
        $Meteo_Hum = $donnees['Meteo_Hum'];
        $Meteo_Light = $donnees['Meteo_Light'];
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
        <title>Station Météo</title>
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <!-- multiple select -->
        <link rel="stylesheet" type="text/css" href="dist/multiple-select.css">
        <link rel="stylesheet" type="text/css" href="dist/themes/bootstrap.css">

        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

        <!-- Datepicker -->
        <link rel="stylesheet" href="css/datepicker.css"> 

        <style type="text/css">
      
            .absolu{position: absolute;}
            
            .haut1{top: 44.5%;}
            .droite1{right: 44%;}


            .haut2{top:57.5%}
            .droite2{right: 44%;}

            .haut3{top:70%}
            .droite3{right: 44%;}

            
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
                        <h1 class="mt-4">Station Météo</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="layout-static - synoptiques.php">Synoptiques</a></li>
                            <li class="breadcrumb-item active">Station Météo</li>
                            <li style="position:absolute;right:4%;font-size:1vw;" class="text-danger"> Dernière mise à jour : <?php echo $TRDate?> à <?php echo $TRheure?></li>
                        </ol>    
                        <div class="card mb-4  bg-light mt-auto">                       
                            <img src="img/SynMT.png" style="margin: auto;width:90%;"> 
                            <p class="font-weight-bold absolu haut1 droite1" style="font-size:1vw;" ><?php echo $Meteo_Temp.' °C'?></p>
                            
                            <p class="font-weight-bold absolu haut2 droite2" style="font-size:1vw;"><?php echo $Meteo_Hum.'  %'?></p>
                            
                            <p class="font-weight-bold absolu haut3 droite3 " style="font-size:1vw;"><?php echo $Meteo_Light.' klux'?></p>                         
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line mr-1"></i>
                                Graphes       
                                <div class="row d-flex justify-content-between">
                                    <div class=" col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <select name="params" data-position='top' id="params" placeholder="paramètres" class="form-control" data-animate ="slide" data-filter ="true" data-filter-placeholder="Rechercher" multiple >
                                                <option   value="0">Meteo_Temp</option>
                                                <option   value="1">Meteo_Hum</option>
                                                <option   value="2">Meteo_Light</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white" id="basic-addon1">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="start_dateGraph" placeholder="Période du..." readonly>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white" id="basic-addon1">
                                                    <i   class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control " id="end_dateGraph" placeholder="Au..." readonly>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <select name="params2" data-position='top' id="params2" placeholder="paramètres" class="form-control" data-animate ="slide" data-filter ="true" data-filter-placeholder="Rechercher" multiple >
                                                <option   value="0">Meteo_Temp</option>
                                                <option   value="1">Meteo_Hum</option>
                                                <option   value="2">Meteo_Light</option>       
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <button id="filterGraph" class="form-control btn btn-outline-info btn-sm">Filtrer</button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="card-body" id="chart_area"  style="width: 1000px; height: 620px;"></div>
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

        <!-- Datepicker -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        


        <script type="text/javascript" language="javascript" src="dist/multiple-select.js"></script>
         <!--graph-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!--scripts filter graph-->
        <!-- Datepicker -->
        <script src="js/Datepicker.js"></script>
        <!--scripts multiple select-->      
        <script type="text/javascript">

            function showAllColums() {

                alert('Action non autorisée, décochez la case s\'il vous plaît')
                jQuery('#params').multipleSelect('uncheckAll')
                        
            }
            

            $(document).ready(function() {

                jQuery('#params').multipleSelect({
                    
                    width:180,
                    onClick: function(view){

                        var selectItems = jQuery('#params').multipleSelect('getSelects');
                        var selectTexts = jQuery('#params').multipleSelect('getSelects', 'text');
                        //on appel la fonction loadData
                        loadData(selectItems,selectTexts);
                        jQuery('#chart_area').css('width','100%');

                    },
                    onCheckAll: function(){

                        showAllColums();
                        jQuery('#chart_area').css('width','100%');

                    }

                });
            } );

        </script>

        <!-- graphe sans filtre -->
        <script type="text/javascript">

            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback();

            function loadData(selectItems,selectTexts){
                if (selectItems.length==1) {

                    if (selectItems[0]==0) {
                        $.ajax({
                        url:"../php/fetchMeteo.php",
                        method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_TempGraph(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==1) {
                        $.ajax({
                        url:"../php/fetchMeteo.php",
                        method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_HumGraph(data);
                            } 
                        });
                    } 
                    else if (selectItems[0]==2) {
                        $.ajax({
                        url:"../php/fetchMeteo.php",
                        method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_LightGraph(data);
                            } 
                        });
                    }                                                                                   
                } 
                else if (selectItems.length>1){

                    showAllColums()

                }      

            }   

            function Meteo_TempGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'Température (°C)');

                //data.addColumn({type:'string', role:'annotation'});

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Temp = parseInt($.trim(jsonData.Meteo_Temp));
                    //data.addRows([[jours,Meteo_Temp,Meteo_Temp+'°C']]);
                    data.addRows([[jours,Meteo_Temp]]);

                });
             /*  var view = new google.visualization.DataView(data);
                    view.setColumns(
                        [
                            0,
                            1,
                            {
                                 calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" 
                            }
                        ]
                    );*/


                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Valeurs'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }

            function Meteo_HumGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'Humidité (%Hr)');
                //annotation 1
                //data.addColumn({type:'string', role:'annotation'});

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Hum = parseInt($.trim(jsonData.Meteo_Hum));
                    //annotation 2
                    //data.addRows([[jours,Meteo_Hum,Meteo_Hum+'(%Hr)']]);
                    data.addRows([[jours,Meteo_Hum]]);

                });


                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Valeurs'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }
            function Meteo_LightGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Ensoleillement (klux)');
                //data.addColumn({type:'string', role:'annotation'});
                
                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Light = parseInt($.trim(jsonData.Meteo_Light));
                    //data.addRows([[jours,Meteo_Light,Meteo_Light+'(klux)']]);
                    data.addRows([[jours,Meteo_Light]]);

                });


                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Valeurs'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }
        </script>

        <!--scripts filter graph-->
        <script type="text/javascript">

            function loadDataGraph(selectItemsGraph,selectTextsGraph,start_dateGraph,end_dateGraph){
                if (selectItemsGraph.length==1) {

                    if (selectItemsGraph[0]==0) {
                        $.ajax({
                        url:"../php/fetchMeteoFilter.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_TempGraphFilter(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==1) {
                        $.ajax({
                        url:"../php/fetchMeteoFilter.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_HumGraphFilter(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==2) {
                        $.ajax({
                        url:"../php/fetchMeteoFilter.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_LightGraphFilter(data);
                            } 
                        });
                    }
                                                                                                
                }

                else{

                    if(selectItemsGraph.length>1){

                        showAllColums3()

                    }
                    else if(selectItems.length==0){

                            selectItems=0;
                            $.ajax({
                            url:"../php/fetchMeteoFilter.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });

                    }
                    
                }

            

            }   

            function Meteo_TempGraphFilter(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Température (°C)');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Temp = parseInt($.trim(jsonData.Meteo_Temp));
                    data.addRows([[jours,Meteo_Temp]]);

                });

                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Données'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }

            function Meteo_HumGraphFilter(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Humidité (%Hr)');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Hum = parseInt($.trim(jsonData.Meteo_Hum));
                    data.addRows([[jours,Meteo_Hum]]);

                });

                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Données'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }

            function Meteo_LightGraphFilter(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Ensoleillement (klux)');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Light = parseInt($.trim(jsonData.Meteo_Light));
                    data.addRows([[jours,Meteo_Light]]);

                });

                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Données'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }

            function EmptyGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'graphe');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var graphe = parseFloat($.trim(jsonData.graphe));
                    data.addRows([[jours,graphe]]);

                });

                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "jours"
                    },
                    vAxis: {
                        title: 'Valeurs'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }   
                        
            function showAllColums3() {

                alert('Action non autorisée, décochez la case s\'il vous plaît')
                jQuery('#params2').multipleSelect('uncheckAll')
                        
            }



            $(document).ready(function() {

                $('#params2').multipleSelect({
                    
                    width:180,
                    onCheckAll: function(){

                        showAllColums3();
                        $('#chart_area').css('width','100%');

                    }

                });
            
            } 
            );

            //lorsqu'on clique sur le bouton filter graph
            $(document).on("click", "#filterGraph", function(e) {
                e.preventDefault();

                var start_dateGraph = $("#start_dateGraph").val();
                var end_dateGraph = $("#end_dateGraph").val();
                var selectItemsGraph = $('#params2').multipleSelect('getSelects');
                var selectTextsGraph = $('#params2').multipleSelect('getSelects', 'text');

                if (start_dateGraph == "" || end_dateGraph == "") {
                    alert("les deux dates sont requises");
                } else {
            
                    loadDataGraph(selectItemsGraph,selectTextsGraph,start_dateGraph,end_dateGraph);
                    $('#chart_area').css('width','100%');
                }
            });
        </script>



        <!--scripts datepicker-->
        <script type="text/javascript">
            $(function() {
                $("#start_dateGraph").datepicker({

                    zIndex: 2048,
                    autoHide: true

                });
                $("#end_dateGraph").datepicker({

                    zIndex: 2048,
                    autoHide: true
                });
                
            });
        </script>

        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
    </body>
</html>
