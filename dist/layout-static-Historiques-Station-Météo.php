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
        <title>Historiques</title>
        
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

        <!-- Datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

         <!-- Datatables -->
         <link rel="stylesheet" type="text/css"      
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
        <!-- multiple select -->
        <link rel="stylesheet" type="text/css" href="dist/multiple-select.css">
        <link rel="stylesheet" type="text/css" href="dist/themes/bootstrap.css">
        <!-- Datepicker -->
        <link rel="stylesheet" href="css/datepicker.css"> 

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
                        <h1 class="mt-4">Historiques</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Historiques</li>
                            <li class="breadcrumb-item active">Station Météo</li>
                        </ol>
                        <div class="row d-flex justify-content-between">
                            <div class=" col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static-Historiques-Conso-Village.php"  class="form-control btn btn-outline-primary btn-sm " style="width:70%">Consommation Village</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static-Historiques-GE.php" class="form-control btn btn-outline-danger btn-sm" style="width:70%">Groupe Electrogène</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href=""  class="form-control btn btn-outline-secondary btn-sm" style="width:70%">Onduleurs</a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="input-group mb-3 justify-content-center">
                                    <a href="layout-static-Historiques-Station-Météo.php"  class="form-control btn btn-outline-success btn-sm" style="width:70%">Station Météo</a>
                                </div>
                            </div>
                        </div>     
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row d-flex justify-content-between">
                                    <div class=" col-xl-3 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white" id="basic-addon1">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="startDate" placeholder="Période du..." readonly>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white" id="basic-addon1">
                                                    <i   class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control " id="endDate" placeholder="Au..." readonly>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <button id="filter" class="btn-sm form-control btn btn-outline-info" >Filtrer</button>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <select name="toggle_column"  id="toggle_column" class="form-control" data-animate ="slide" data-filter ="true" data-filter-placeholder="Rechercher" multiple >
                                                <option  selected="selected" value="0">TRId</option>
                                                <option  selected="selected" value="1">TRDate</option>
                                                <option  selected="selected" value="2">TRHeure</option>
                                                <option  selected="selected" value="3">Meteo_Temp</option>
                                                <option  selected="selected" value="4">Meteo_Hum</option>
                                                <option  selected="selected" value="5">Meteo_Light</option>   
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>TRId</th>
                                                <th style="width:30%">TRDate</th>
                                                <th>TRHeure</th>
                                                <th>Meteo_Temp</th>
                                                <th>Meteo_Hum</th>
                                                <th>Meteo_Light</th>                                 
                                            </tr>
                                        </thead>
                                        <tbody>                           
                                        </tbody>        
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line mr-1"></i>
                                Graphes       
                                <div class="row d-flex justify-content-between">
                                    <div class=" col-xl-2 col-md-6">
                                        <div class="input-group mb-3 justify-content-center">
                                            <select name="params" data-position='top' id="params" placeholder="paramètres" class="form-control" data-animate ="slide" data-filter ="false" data-filter-placeholder="Rechercher" multiple >
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
                                            <select name="params2" data-position='top' id="params2" placeholder="paramètres" class="form-control" data-animate ="slide" data-filter ="false" data-filter-placeholder="Rechercher" multiple >
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
                            <div class="panel-body" id="chart_area" style="width: 1000px; height: 620px;" ></div>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/datatables.js" crossorigin="anonymous"></script>
            <!-- Momentjs pour la date format dd/mm//aa-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js" type="text/javascript"></script>  
        <script src="//cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js" type="text/javascript"></script>
        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
        <!-- Datepicker -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Datepicker -->
        <script src="js/Datepicker.js"></script>
        <!-- multiple select -->
        <script type="text/javascript" language="javascript" src="dist/multiple-select.js"></script>


        <!--scripts datepicker-->
        <script type="text/javascript">
            $(function() {
                $("#startDate").datepicker({

                    zIndex: 2048,
                    autoHide: true

                });
                $("#endDate").datepicker({

                    zIndex: 2048,
                    autoHide: true
                });

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


        <!--scripts pour le tableau-->
        <!--scripts filter le tableau par date-->
        <script type="text/javascript">

            // Fetch records

            function fetch(start_date, end_date) {
                var option =3;
                $.ajax({
                    url: "../php/records.php",
                    type: "POST",
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        option:option
                    },
                    dataType: "json",
                    success: function(data) {
                        // Datatables
                        my_table =  $('#example').DataTable({
                            "data": data,
                            // buttons
                            "dom": "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                                "<'row'<'col-sm-12'tr>>" +
                                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                            buttons: [
                            {
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
                                "excel","pdf",'csv'
                
                            ],
                            // responsive
                            "responsive": true,
                            "columns": [
                                {"data": "TRId"},
                                {"data": "TRDate", render: $.fn.dataTable.render.moment( 'DD-MM-YYYY' )},
                                {"data": "TRHeure"},
                                {"data": "Meteo_Temp"},
                                {"data": "Meteo_Hum"},
                                {"data": "Meteo_Light"}
                                
                            ],
                            "order": [[ 1, 'desc' ]]
                        });
        
                    }
                });
            }

    
            fetch();
            
        
            // Filter

            $(document).on("click", "#filter", function(e) {
                e.preventDefault();

                var start_date = $("#startDate").val();
                var end_date = $("#endDate").val();

                if (start_date == "" || end_date == "") {
                    alert("les deux dates sont requises");
                } else {
                    $('#example').DataTable().destroy();
                    fetch(start_date, end_date);
                }
            });

            // Reset

            $(document).on("click", "#reset", function(e) {
                e.preventDefault();

                $("#startDate").val(''); // empty value
                $("#endDate").val('');

                $('#example').DataTable().destroy();
                fetch();
            });

            
                function hideAllColums() {
                    for (let index = 0; index < 6; index++) {

                        my_table.column(index).visible(0) ;
                        
                    }
                    
                }

                function showAllColums() {
                    for (let index = 0; index < 6; index++) {

                        my_table.column(index).visible(1) ;
                        
                    }
                    
                }
                
            
            $(document).ready(function() {

                
                jQuery('#toggle_column').multipleSelect({
                    
                    width:180,
                    onClick: function(view){

                        var selectItems = $('#toggle_column').multipleSelect('getSelects');
                        hideAllColums();
                        for (var index = 0; index < selectItems.length; index++) {
                            var s = selectItems[index];
                            my_table.column(s).visible(1) ;
                        }
                        $('#example').css('width','100%');

                    } ,
                    onCheckAll: function(){

                        showAllColums();
                        jQuery('#example').css('width','100%');

                    },
                    onUncheckAll: function(){

                        hideAllColums();
                        jQuery('#example').css('width','100%');

                    }

                });
            } );

        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">

            function showAllColums2() {

                alert('Action non autorisée')
                jQuery('#params').multipleSelect('uncheckAll')
                        
            }


            $(document).ready(function() {

                $('#params').multipleSelect({
                    
                    width:180,
                    onClick: function(view){

                        var selectItems = jQuery('#params').multipleSelect('getSelects');
                        var selectTexts = jQuery('#params').multipleSelect('getSelects', 'text');
                        //on appel la fonction loadData
                        loadData(selectItems,selectTexts);
                        jQuery('#chart_area').css('width','100%');

                    },
                    onCheckAll: function(){

                        showAllColums2();
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
                                Meteo_Temp(data);
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
                                Meteo_Hum(data);
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
                                Meteo_Light(data);
                            } 
                        });
                    }                                                                    
                }  
                else{

                    if(selectItems.length>1){
                        alert('Action non autorisée')
                        $('#params').multipleSelect('uncheckAll');
                            selectItems=0;
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });
                    }
                    else if(selectItems.length==0){

                            selectItems=0;
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });

                    }
                     
                }

            }

            function Meteo_Temp(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'Témpérature extérieure');

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
                        title: 'Valeurs'
                    },
                    annotations: {
                    alwaysOutside: true
                    },
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }
                                                                

            function Meteo_Hum(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'Humidité extérieure');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Hum = parseInt($.trim(jsonData.Meteo_Hum)) ;
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
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            } 
            
            function Meteo_Light(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', ' Luminosité extérieure');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var Meteo_Light = parseInt($.trim(jsonData.Meteo_Light)) ;
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
                    legend: { position: 'top' }
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
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }             
        </script>

        <!--scripts filter graph-->


        <!--scripts filter graph-->
        <script type="text/javascript">

            function loadDataGraph(selectItemsGraph,selectTextsGraph,start_dateGraph,end_dateGraph){
                if (selectItemsGraph.length==1) {

                    if (selectItemsGraph[0]==0) {
                        $.ajax({
                        url:"../php/fetchMeteoGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_TempGraph(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==1) {
                        $.ajax({
                        url:"../php/fetchMeteoGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_HumGraph(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==2) {
                        $.ajax({
                        url:"../php/fetchMeteoGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Meteo_LightGraph(data);
                            } 
                        });
                    }

                                                                                                       
                }

                else{

                    if(selectItemsGraph.length>1){

                        alert('Action non autorisée')
                        $('#params2').multipleSelect('uncheckAll');
                        selectItems=0;
                            $.ajax({
                            url:"../php/fetchMeteo.php",
                            method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });

                    }
                    else if(selectItems.length==0){

                            selectItems=0;
                            $.ajax({
                            url:"../php/fetchGraphGE.php",
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

            function Meteo_TempGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Témpérature extérieur');

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
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }

            function Meteo_HumGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Humidité extérieure');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var Meteo_Hum = parseInt($.trim(jsonData.Meteo_Hum));
                    data.addRows([[datHeure,Meteo_Hum]]);

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
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }


            function Meteo_LightGraph(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'Luminosité extérieure');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var Meteo_Light = parseInt($.trim(jsonData.Meteo_Light));
                    data.addRows([[datHeure,Meteo_Light]]);

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
                    legend: { position: 'top' }
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
                    legend: { position: 'top' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            }                                                                                                                                                                                                           
              

            function showAllColums3() {

                alert('Action non autorisée')
                jQuery('#params2').multipleSelect('uncheckAll')
                $('#params2').multipleSelect('uncheckAll');
                        selectItems=0;
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                            data:{selectItems:selectItems},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });
                        
            }

            $(document).ready(function() {

                $('#params2').multipleSelect({
                    
                    width:180,
                    onCheckAll: function(){

                        showAllColums3();
                        $('#chart_area').css('width','100%');

                    }

                });
            } );

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
        <script>            
            setTimeout ("window.location='../logout.php'", 900000);          
        </script> 
    </body>
</html>
