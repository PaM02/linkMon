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
                            <li class="breadcrumb-item active">Consommation village</li>
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
                                                <option  selected="selected" value="3">Secteur 1</option>
                                                <option  selected="selected" value="4">Secteur 2</option>
                                                <option  selected="selected" value="5">Secteur 3</option>
                                                <option   value="6">Tension U1</option>
                                                <option   value="7">Tension U2</option>
                                                <option   value="8">Tension U3</option>
                                                <option   value="9">Courant I1</option>
                                                <option   value="10">Courant I2</option>
                                                <option   value="11">Courant I3</option>
                                                <option   value="12">Puissance P1</option>
                                                <option   value="13">Puissance P2</option>
                                                <option   value="14">Puissance P3</option>
                                                <option   value="15">Fréquence</option>
                                                <option   value="16">Energie E1</option>
                                                <option   value="17">Energie E2</option>
                                                <option   value="18">Energie E3</option>
                                                <option   value="19">Energie totale</option>
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
                                                <th>Secteur 1</th>
                                                <th>Secteur 2</th>
                                                <th>Secteur 3</th>                                 
                                                <th>Tension U1</th>
                                                <th>Tension U2</th>
                                                <th>Tension U3</th>
                                                <th>Courant I1</th>
                                                <th>Courant I2</th>
                                                <th>Courant I3</th>
                                                <th>Puissance P1</th>
                                                <th>Puissance P2</th>
                                                <th>Puissance P3</th>
                                                <th>Fréquence</th>
                                                <th>Energie E1</th>
                                                <th>Energie E2</th>
                                                <th>Energie E3</th>
                                                <th>Energie totale</th>
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
                                                <option   value="0">Secteur 1</option>
                                                <option   value="1">Secteur 2</option>
                                                <option   value="2">Secteur 3</option>
                                                <option   value="3">Tension U1</option>
                                                <option   value="4">Tension U2</option>
                                                <option   value="5">Tension U3</option>
                                                <option   value="6">Courant I1</option>
                                                <option   value="7">Courant I2</option>
                                                <option   value="8">Courant I3</option>
                                                <option   value="9">Puissance P1</option>
                                                <option   value="10">Puissance P2</option>
                                                <option   value="11">Puissance P3</option>
                                                <option   value="12">Fréquence</option>
                                                <option   value="13">Energie E1</option>
                                                <option   value="14">Energie E2</option>
                                                <option   value="15">Energie E3</option>  
                                                <option   value="16">Energie totale</option>      
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
                                                <option   value="0">Secteur 1</option>
                                                <option   value="1">Secteur 2</option>
                                                <option   value="2">Secteur 3</option>
                                                <option   value="3">Tension U1</option>
                                                <option   value="4">Tension U2</option>
                                                <option   value="5">Tension U3</option>
                                                <option   value="6">Courant I1</option>
                                                <option   value="7">Courant I2</option>
                                                <option   value="8">Courant I3</option>
                                                <option   value="9">Puissance P1</option>
                                                <option   value="10">Puissance P2</option>
                                                <option   value="11">Puissance P3</option>
                                                <option   value="12">Fréquence</option>
                                                <option   value="13">Energie E1</option>
                                                <option   value="14">Energie E2</option>
                                                <option   value="15">Energie E3</option>  
                                                <option   value="16">Energie totale</option>     
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
                var option =1;
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
                                {"data": "Secteur_1"},
                                {"data": "Secteur_2"},
                                {"data": "Secteur_3"},
                                {"data": "CE_U1"},
                                {"data": "CE_U2"},
                                {"data": "CE_U3"},
                                {"data": "CE_I1"},
                                {"data": "CE_I2"},
                                {"data": "CE_I3"},
                                {"data": "CE_P1"},
                                {"data": "CE_P2"},
                                {"data": "CE_P3"},
                                {"data": "CE_FREQUENCE"},
                                {"data": "CE_E1"},
                                {"data": "CE_E2"},
                                {"data": "CE_E3"},
                                {"data": "CE_E"}
                            ],
                            "order": [[ 0, 'desc' ]]
                        });
                        
                            // Hide  columns
                            for (let index = 6; index <20; index++) {

                                my_table.column(index).visible(0);
                                
                            }
        
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
                    for (let index = 0; index < 20; index++) {

                        my_table.column(index).visible(0) ;
                        
                    }
                    
                }

                function showAllColums() {
                    for (let index = 0; index < 20; index++) {

                        my_table.column(index).visible(1) ;
                        
                    }
                    
                }
                

            $(document).ready(function() {

                
                jQuery('#toggle_column').multipleSelect({
                    
                    width:180,
                    onClick: function(view){

                        var selectItems = jQuery('#toggle_column').multipleSelect('getSelects');
                        hideAllColums();
                        for (var index = 0; index < selectItems.length; index++) {
                            var s = selectItems[index];
                            my_table.column(s).visible(1) ;
                        }
                        jQuery('#example').css('width','100%');

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

         <!-- graphe sans filtre -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback();

            function loadData(selectItems,selectTexts){
                var option = 1;
                if (selectItems.length==1) {

                    if (selectItems[0]==0) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Secteur1(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==1) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Secteur2(data);
                            } 
                        });
                    }

                    else if (selectItems[0]==2) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Secteur3(data);
                            } 
                        });
                    }

                    else if (selectItems[0]==3) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Tension1(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==4) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Tension2(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==5) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Tension3(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==6) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Courant1(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==7) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Courant2(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==8) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Courant3(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==9) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Puissance1(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==10) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Puissance2(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==11) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Puissance3(data);
                            } 
                        });
                    }
                    else if (selectItems[0]==12) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Frequence(data);
                            } 
                        });
                    }

                    else if (selectItems[0]==13) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Energie1(data);
                            } 
                        });
                    } 

                    else if (selectItems[0]==14) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Energie2(data);
                            } 
                        });
                    } 
                    else if (selectItems[0]==15) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Energie3(data);
                            } 
                        });
                    } 

                    else if (selectItems[0]==16) {
                        $.ajax({
                        url:"../php/fetch.php",
                        method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                Energie(data);
                            } 
                        });
                    }                                                                              
                }

                else if (selectItems.length==2) {

                    if ((selectItems[0]==0 && selectItems[1]==1)) {
                        if((selectTexts[0]=='Secteur 1' && selectTexts[1]=='Secteur 2')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Secteur12(data);
                                } 
                            });
                        }   
                    }
                    else if ((selectItems[0]==0 && selectItems[1]==2)) {
                        if((selectTexts[0]=='Secteur 1' && selectTexts[1]=='Secteur 3')){
                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                    data:{selectItems:selectItems,option:option},
                                    dataType:"JSON",
                                    success:function(data)
                                    {   
                                        Secteur13(data);
                                    } 
                                });
                            }
                    }

                    else if ((selectItems[0]==1 && selectItems[1]==2)) {
                        if((selectTexts[0]=='Secteur 2' && selectTexts[1]=='Secteur 3')){

                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Secteur23(data);
                                } 
                            });

                        }
                    }

                    else if ((selectItems[0]==3 && selectItems[1]==4)) {
                        if((selectTexts[0]=='Tension U1' && selectTexts[1]=='Tension U2')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Tension12(data);
                                } 
                            });
                        }   
                    }
                    else if ((selectItems[0]==3 && selectItems[1]==5)) {
                        if((selectTexts[0]=='Tension U1' && selectTexts[1]=='Tension U3')){
                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                    data:{selectItems:selectItems,option:option},
                                    dataType:"JSON",
                                    success:function(data)
                                    {   
                                        Tension13(data);
                                    } 
                                });
                            }
                    }

                    else if ((selectItems[0]==4 && selectItems[1]==5)) {
                        if((selectTexts[0]=='Tension U2' && selectTexts[1]=='Tension U3')){

                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Tension23(data);
                                } 
                            });

                        }
                    }
                    else if ((selectItems[0]==6 && selectItems[1]==7)) {
                        if((selectTexts[0]=='Courant I1' && selectTexts[1]=='Courant I2')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Courant12(data);
                                } 
                            });
                        }   
                    }
                    else if ((selectItems[0]==6 && selectItems[1]==8)) {
                        if((selectTexts[0]=='Courant I1' && selectTexts[1]=='Courant I3')){
                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                    data:{selectItems:selectItems,option:option},
                                    dataType:"JSON",
                                    success:function(data)
                                    {   
                                        Courant13(data);
                                    } 
                                });
                            }
                    }

                    else if ((selectItems[0]==7 && selectItems[1]==8)) {
                        if((selectTexts[0]=='Courant I2' && selectTexts[1]=='Courant I3')){

                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Courant23(data);
                                } 
                            });

                        }
                    }
                    else if ((selectItems[0]==9 && selectItems[1]==10)) {
                        if((selectTexts[0]=='Puissance P1' && selectTexts[1]=='Puissance P2')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Puissance12(data);
                                } 
                            });
                        }   
                    }
                    else if ((selectItems[0]==9 && selectItems[1]==11)) {
                        if((selectTexts[0]=='Puissance P1' && selectTexts[1]=='Puissance P3')){
                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                    data:{selectItems:selectItems,option:option},
                                    dataType:"JSON",
                                    success:function(data)
                                    {   
                                        Puissance13(data);
                                    } 
                                });
                            }
                    }

                    else if ((selectItems[0]==10 && selectItems[1]==11)) {
                        if((selectTexts[0]=='Puissance P2' && selectTexts[1]=='Puissance P3')){

                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Puissance23(data);
                                } 
                            });

                        }
                    }

                    else if ((selectItems[0]==13 && selectItems[1]==14)) {

                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie12(data);
                                } 
                            });
                           
                    }
                    else if ((selectItems[0]==13 && selectItems[1]==15)) {

                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                    data:{selectItems:selectItems,option:option},
                                    dataType:"JSON",
                                    success:function(data)
                                    {   
                                        Energie13(data);
                                    } 
                                });
                            
                    }

                    else if ((selectItems[0]==14 && selectItems[1]==15)) {


                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie23(data);
                                } 
                            });

                        
                    } 

                    else if ((selectItems[0]==13 && selectItems[1]==16)) {


                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie1T(data);
                                } 
                            });

                        
                    } 

                    else if ((selectItems[0]==14 && selectItems[1]==16)) {


                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie2T(data);
                                } 
                            });

                        
                    }  

                    else if ((selectItems[0]==15 && selectItems[1]==16)) {


                            $.ajax({
                                url:"../php/fetch.php",
                                method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie3T(data);
                                } 
                            });

        
                    }                                                                            
                    else{

                        alert('Action non autorisée')
                        //derniereValeur = selectItems.pop();
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
                        //jQuery('#params').multipleSelect('uncheck', derniereValeur)
                    }

                }

                else if (selectItems.length==3) {

                    if ((selectItems[0]==0 && selectItems[1]==1 && selectItems[2]==2)) {
                        if((selectTexts[0]=='Secteur 1' && selectTexts[1]=='Secteur 2' && selectTexts[2]=='Secteur 3')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Secteur123(data);
                                } 
                            });
                        }
                    }

                    else if ((selectItems[0]==3 && selectItems[1]==4 && selectItems[2]==5)) {
                        if((selectTexts[0]=='Tension U1' && selectTexts[1]=='Tension U2' && selectTexts[2]=='Tension U3')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Tension123(data);
                                } 
                            });
                        }
                    }
                    else if ((selectItems[0]==6 && selectItems[1]==7 && selectItems[2]==8)) {
                        if((selectTexts[0]=='Courant I1' && selectTexts[1]=='Courant I2' && selectTexts[2]=='Courant I3')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Courant123(data);
                                } 
                            });
                        }
                    }
                    else if ((selectItems[0]==9 && selectItems[1]==10 && selectItems[2]==11)) {
                        if((selectTexts[0]=='Puissance P1' && selectTexts[1]=='Puissance P2' && selectTexts[2]=='Puissance P3')){
                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Puissance123(data);
                                } 
                            });
                        }
                    }
                    else if ((selectItems[0]==13 && selectItems[1]==14 && selectItems[2]==15)) {

                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {   
                                    Energie123(data);
                                } 
                            });
                        
                    }

                    else if ((selectItems[0]==13 && selectItems[1]==14 && selectItems[2]==16)) {

                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {    
                                Energie12T(data);
                            } 
                        });
                    
                    }  

                    else if ((selectItems[0]==13 && selectItems[1]==15 && selectItems[2]==16)) {

                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                { 
                                Energie13T(data);
                            } 
                        });
                    
                    }  

                    else if ((selectItems[0]==14 && selectItems[1]==15 && selectItems[2]==16)) {

                            $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                                data:{selectItems:selectItems,option:option},
                                dataType:"JSON",
                                success:function(data)
                                {    
                                Energie23T(data);
                            } 
                        });
                    
                    }                    

                    else{

                        //derniereValeur = selectItems.pop();

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
                        //jQuery('#params').multipleSelect('uncheck', derniereValeur)
                    }

                }
                else if (selectItems.length==4) {

                     if ((selectItems[0]==13 && selectItems[1]==14 && selectItems[2]==15&& selectItems[3]==16)) {

                        $.ajax({
                            url:"../php/fetch.php",
                            method:"POST",
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                Energie123T(data);
                            } 
                        });
                    
                    }
                    else{
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
                    
                }
                else{

                    if(selectItems.length>4){

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
                            data:{selectItems:selectItems,option:option},
                            dataType:"JSON",
                            success:function(data)
                            {    
                                EmptyGraph(data);
                            } 
                        });

                    }
                     
                }

            }

            function Secteur1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    data.addRows([[jours,secteur1]]);

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

            function Secteur2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    data.addRows([[jours,secteur2]]);

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

            function Courant2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    data.addRows([[jours,courant2]]);

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

            function Puissance2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    data.addRows([[jours,puissance2]]);

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

            function Secteur3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[jours,secteur3]]);

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

            function Tension1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    data.addRows([[jours,tension1]]);

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

            function Courant1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    data.addRows([[jours,courant1]]);

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

            function Puissance1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    data.addRows([[jours,puissance1]]);

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

            function Frequence(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'frequence');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var frequence = parseFloat($.trim(jsonData.frequence));
                    data.addRows([[jours,frequence]]);

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

            function Energie1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    data.addRows([[jours,energie1]]);

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
                    legend: { position: 'top.' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
                chart.draw(data, options);
            } 


            function Energie2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[jours,energie2]]);

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


            function Energie3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[jours,energie3]]);

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

            function Energie(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie = parseFloat($.trim(jsonData.energie));
                    data.addRows([[jours,energie]]);

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

            function Tension2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    data.addRows([[jours,tension2]]);

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

            function Tension3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[jours,tension3]]);

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

            function Courant3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[jours,courant3]]);

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

            function Puissance3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[jours,puissance3]]);

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


            function Secteur12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    data.addRows([[jours,secteur1,secteur2]]);

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

            function Tension12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    data.addRows([[jours,tension1,tension2]]);

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

            function Courant12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    data.addRows([[jours,courant1,courant2]]);

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

            function Puissance12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    data.addRows([[jours,puissance1,puissance2]]);

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


            function Energie12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[jours,energie1,energie2]]);

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

            function Secteur13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[jours,secteur1,secteur3]]);

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

            function Tension13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[jours,tension1,tension3]]);

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

            function Courant13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[jours,courant1,courant3]]);

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

            function Puissance13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[jours,puissance1,puissance3]]);

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

            function Energie13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[jours,energie1,energie3]]);

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


            function Secteur23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur2');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[jours,secteur2,secteur3]]);

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

            function Tension23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension2');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[jours,tension2,tension3]]);

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

            function Courant23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant2');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[jours,courant2,courant3]]);

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

            function Puissance23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance2');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[jours,puissance2,puissance3]]);

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

            function Energie23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[jours,energie3,energie2]]);

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

            function Energie1T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    data.addRows([[jours,energie1,energie]]);

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


            function Energie2T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie totale');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[jours,energie,energie2]]);

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

            function Energie3T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    var energie = parseFloat($.trim(jsonData.energie));
                    data.addRows([[jours,energie3,energie]]);

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



            function Secteur123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur2');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var secteur1 = parseFloat($.trim(jsonData.secteur1));
                    var secteur2 = parseFloat($.trim(jsonData.secteur2));
                    var secteur3 = parseFloat($.trim(jsonData.secteur3));

                    data.addRows([[jours,secteur1,secteur2,secteur3]]);


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


            function Tension123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension2');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    var tension3 = parseFloat($.trim(jsonData.tension3));

                    data.addRows([[jours,tension1,tension2,tension3]]);


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

            function Courant123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant2');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    var courant3 = parseFloat($.trim(jsonData.courant3));

                    data.addRows([[jours,courant1,courant2,courant3]]);


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

            function Puissance123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance2');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));

                    data.addRows([[jours,puissance1,puissance2,puissance3]]);


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

            function Energie123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));

                    data.addRows([[jours,energie1,energie2,energie3]]);


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

            function Energie12T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie = parseFloat($.trim(jsonData.energie));

                    data.addRows([[jours,energie1,energie2,energie]]);


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

            function Energie13T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie3 = parseFloat($.trim(jsonData.energie3));

                    data.addRows([[jours,energie1,energie,energie3]]);


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

            function Energie23T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));

                    data.addRows([[jours,energie,energie2,energie3]]);


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

            function Energie123T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));

                    data.addRows([[jours,energie,energie1,energie2,energie3]]);


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

        <script type="text/javascript">

            function showAllColums2() {

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

                        showAllColums2();
                        jQuery('#chart_area').css('width','100%');

                    }

                });
            } );

        </script>
        <!--scripts filter graph-->
        <script type="text/javascript">

            function loadDataGraph(selectItemsGraph,selectTextsGraph,start_dateGraph,end_dateGraph){
                if (selectItemsGraph.length==1) {

                    if (selectItemsGraph[0]==0) {
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur1(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==1) {
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur2(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==2) {
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur3(data);
                            } 
                        });
                    }

                    else if (selectItemsGraph[0]==3) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension1(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==4) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension2(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==5) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension3(data);
                            } 
                        });
                    }

                    else if (selectItemsGraph[0]==6) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant1(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==7) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant2(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==8) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant3(data);
                            } 
                        });
                    } 

                    else if (selectItemsGraph[0]==9) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance1(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==10) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance2(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==11) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance1(data);
                            } 
                        });
                    } 
                    else if (selectItemsGraph[0]==12) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphFrequence(data);
                            } 
                        });
                    } 

                    else if (selectItemsGraph[0]==13) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie1(data);
                            } 
                        });
                    }
                    else if (selectItemsGraph[0]==14) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie2(data);
                            } 
                        });
                    } 
                    else if (selectItemsGraph[0]==15) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie3(data);
                            } 
                        });
                    } 
                    else if (selectItemsGraph[0]==16) {
                        $.ajax({
                            url:"../php/fetchGraph.php",
                            method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergieTotale(data);
                            } 
                        });
                    }                                                                                                
                }

                else if(selectItemsGraph.length==2){

                    if ((selectItemsGraph[0]==0 && selectItemsGraph[1]==1)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur12(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==0 && selectItemsGraph[1]==2)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur13(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==1 && selectItemsGraph[1]==2)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur23(data);
                            } 
                        });
                           
                    } 

                    else if ((selectItemsGraph[0]==3 && selectItemsGraph[1]==4)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension12(data);
                            } 
                        });
                           
                    }
                    
                    else if ((selectItemsGraph[0]==3 && selectItemsGraph[1]==5)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension13(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==4 && selectItemsGraph[1]==5)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension23(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==6 && selectItemsGraph[1]==7)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant12(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==6 && selectItemsGraph[1]==8)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant13(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==7 && selectItemsGraph[1]==8)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant23(data);
                            } 
                        });
                           
                    } 

                     else if ((selectItemsGraph[0]==9 && selectItemsGraph[1]==10)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance12(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==9 && selectItemsGraph[1]==11)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance13(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==10 && selectItemsGraph[1]==11)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance23(data);
                            } 
                        });
                           
                    }   

                     else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==14)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie12(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==15)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie13(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==14 && selectItemsGraph[1]==15)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie23(data);
                            } 
                        });
                           
                    } 

                    else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==16)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie1T(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==14 && selectItemsGraph[1]==16)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie2T(data);
                            } 
                        });
                           
                    }

                    else if ((selectItemsGraph[0]==15 && selectItemsGraph[1]==16)) {
                        
                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie3T(data);
                            } 
                        });
                           
                    }                                                          

                    else{

                        alert('Action non autorisée')
                        //derniereValeur = selectItems.pop();
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
                        //jQuery('#params').multipleSelect('uncheck', derniereValeur)
                    }
                }
                else if (selectItemsGraph.length==3) {

                    if ((selectItemsGraph[0]==0 && selectItemsGraph[1]==1 && selectItemsGraph[2]==2)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphSecteur123(data);
                            } 
                        });
                    
                    } 
                    else if ((selectItemsGraph[0]==3 && selectItemsGraph[1]==4 && selectItemsGraph[2]==5)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphTension123(data);
                            } 
                        });
                    
                    }

                    else if ((selectItemsGraph[0]==6 && selectItemsGraph[1]==7 && selectItemsGraph[2]==8)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphCourant123(data);
                            } 
                        });
                    
                    } 

                    else if ((selectItemsGraph[0]==9 && selectItemsGraph[1]==10 && selectItemsGraph[2]==11)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphPuissance123(data);
                            } 
                        });
                    
                    }  

                    else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==14 && selectItemsGraph[2]==15)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie123(data);
                            } 
                        });
                    
                    }

                    else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==14 && selectItemsGraph[2]==16)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie12T(data);
                            } 
                        });
                    
                    }  

                    else if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==15 && selectItemsGraph[2]==16)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie13T(data);
                            } 
                        });
                    
                    }  

                    else if ((selectItemsGraph[0]==14 && selectItemsGraph[1]==15 && selectItemsGraph[2]==16)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie23T(data);
                            } 
                        });
                    
                    }                                                        

                    else{
                        //derniereValeur = selectItems.pop();

                        alert('Action non autorisée')
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
                        //jQuery('#params').multipleSelect('uncheck', derniereValeur)
                    }                                                                                                                 
                }

                else if (selectItemsGraph.length==4){

                    if ((selectItemsGraph[0]==13 && selectItemsGraph[1]==14 && selectItemsGraph[2]==15 && selectItemsGraph[3]==16)) {

                        $.ajax({
                        url:"../php/fetchGraph.php",
                        method:"POST",
                            data:{selectItemsGraph:selectItemsGraph,start_dateGraph: start_dateGraph,end_dateGraph: end_dateGraph},
                            dataType:"JSON",
                            success:function(data)
                            {   
                                GraphEnergie123T(data);
                            } 
                        });
                    
                    }
                    else{
                    //derniereValeur = selectItems.pop();

                    alert('Action non autorisée')
                    //jQuery('#params').multipleSelect('uncheck', derniereValeur)
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

                } 

                else{

                    if(selectItemsGraph.length>4){

                        alert('Action non autorisée')
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
                    else if(selectItems.length==0){

                            selectItems=0;
                            $.ajax({
                            url:"../php/fetchGraph.php",
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

            function GraphSecteur1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    data.addRows([[datHeure,secteur1]]);

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

            function GraphTension1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    data.addRows([[datHeure,tension1]]);

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


            function GraphCourant1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    data.addRows([[datHeure,courant1]]);

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

            function GraphPuissance1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    data.addRows([[datHeure,puissance1]]);

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

            function GraphFrequence(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'frequence');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var frequence = parseFloat($.trim(jsonData.frequence));
                    data.addRows([[datHeure,frequence]]);

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

            function GraphEnergie1(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    data.addRows([[datHeure,energie1]]);

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


            function GraphSecteur2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    data.addRows([[datHeure,secteur2]]);

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

            function GraphTension2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    data.addRows([[datHeure,tension2]]);

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

            function GraphCourant2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    data.addRows([[datHeure,courant2]]);

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

            function GraphPuissance2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    data.addRows([[datHeure,puissance2]]);

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

            function GraphEnergie2(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[datHeure,energie2]]);

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

            function GraphSecteur3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[datHeure,secteur3]]);

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

            function GraphTension3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[datHeure,tension3]]);

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

            function GraphCourant3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[datHeure,courant3]]);

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

            function GraphPuissance3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[datHeure,puissance3]]);

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

            function GraphEnergie3(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie3]]);

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

             function GraphEnergieTotale(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie = parseFloat($.trim(jsonData.energie));
                    data.addRows([[datHeure,energie]]);

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

            function GraphSecteur12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    data.addRows([[datHeure,secteur1,secteur2]]);

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

            function GraphTension12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    data.addRows([[datHeure,tension1,tension2]]);

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

            function GraphCourant12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    data.addRows([[datHeure,courant1,courant2]]);

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

            function GraphPuissance12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    data.addRows([[datHeure,puissance1,puissance2]]);

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

            function GraphEnergie12(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[datHeure,energie1,energie2]]);

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


            function GraphEnergie1T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie totale');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie = parseFloat($.trim(jsonData.energie));
                    data.addRows([[datHeure,energie1,energie]]);

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

            function GraphSecteur13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[datHeure,secteur1,secteur3]]);

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

            function GraphTension13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[datHeure,tension1,tension3]]);

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

            function GraphCourant13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[datHeure,courant1,courant3]]);

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

            function GraphPuissance13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[datHeure,puissance1,puissance3]]);

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

            function GraphEnergie13(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie1,energie3]]);

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

            function GraphEnergie2T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie2');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    data.addRows([[datHeure,energie,energie2]]);

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

            function GraphSecteur23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur2');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[datHeure,secteur2,secteur3]]);

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

            function GraphTension23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension2');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    var tension3 = parseFloat($.trim(jsonData.tension3));
                    data.addRows([[datHeure,tension2,tension3]]);

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

            function GraphCourant23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant2');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[datHeure,courant2,courant3]]);

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

            function GraphPuissance23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance2');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[datHeure,puissance2,puissance3]]);

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

            function GraphEnergie23(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie2,energie3]]);

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

            function GraphEnergie3T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie,energie3]]);

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

            function GraphSecteur123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'secteur1');
                data.addColumn('number', 'secteur2');
                data.addColumn('number', 'secteur3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var secteur1 = parseInt($.trim(jsonData.secteur1));
                    var secteur2 = parseInt($.trim(jsonData.secteur2));
                    var secteur3 = parseInt($.trim(jsonData.secteur3));
                    data.addRows([[datHeure,secteur1,secteur2,secteur3]]);

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

            function GraphTension123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'tension1');
                data.addColumn('number', 'tension2');
                data.addColumn('number', 'tension3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var tension1 = parseFloat($.trim(jsonData.tension1));
                    var tension2 = parseFloat($.trim(jsonData.tension2));
                    var tension3 = parseFloat($.trim(jsonData.secteur3));
                    data.addRows([[datHeure,tension1,tension2,tension3]]);

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

            function GraphCourant123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'courant1');
                data.addColumn('number', 'courant2');
                data.addColumn('number', 'courant3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var courant1 = parseFloat($.trim(jsonData.courant1));
                    var courant2 = parseFloat($.trim(jsonData.courant2));
                    var courant3 = parseFloat($.trim(jsonData.courant3));
                    data.addRows([[datHeure,courant1,courant2,courant3]]);

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


            function GraphPuissance123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'puissance1');
                data.addColumn('number', 'puissance2');
                data.addColumn('number', 'puissance3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var puissance1 = parseFloat($.trim(jsonData.puissance1));
                    var puissance2 = parseFloat($.trim(jsonData.puissance2));
                    var puissance3 = parseFloat($.trim(jsonData.puissance3));
                    data.addRows([[datHeure,puissance1,puissance2,puissance3]]);

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

            function GraphEnergie123(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie1,energie2,energie3]]);

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


            function GraphEnergie12T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie totale');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie = parseFloat($.trim(jsonData.energie));
                    data.addRows([[datHeure,energie1,energie2,energie]]);

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


            function GraphEnergie13T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie1,energie,energie3]]);

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

            function GraphEnergie23T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie,energie2,energie3]]);

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


            function GraphEnergie123T(chart_data, chart_main_title){
                var jsonData = chart_data;
                var data = new google.visualization.DataTable();
                
                data.addColumn('string', 'jours');
                data.addColumn('number', 'energie totale');
                data.addColumn('number', 'energie1');
                data.addColumn('number', 'energie2');
                data.addColumn('number', 'energie3');

                $.each(jsonData, function(i, jsonData){
                    var jours = jsonData.jours;
                    var heure = jsonData.heure;
                    var datHeure = jours+","+heure;
                    var energie = parseFloat($.trim(jsonData.energie));
                    var energie1 = parseFloat($.trim(jsonData.energie1));
                    var energie2 = parseFloat($.trim(jsonData.energie2));
                    var energie3 = parseFloat($.trim(jsonData.energie3));
                    data.addRows([[datHeure,energie,energie1,energie2,energie3]]);

                });

                var options = {
                    title:chart_main_title,
                    hAxis: {
                        title: "Jours"
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

            function showAllColums3() {

                alert('Action non autorisée')
                jQuery('#params2').multipleSelect('uncheckAll')
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
