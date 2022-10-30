<?php

    include 'model.php';

    $model = new Model();

    function Dates($date){

        $jour=substr($date,0,2);
        $mois =substr($date,3,2);
        $annee = substr($date,6,4);
        $formatAnglais = $annee.'-'.$mois.'-'.$jour;
        return $formatAnglais;
    }

    $option = (isset($_POST['option'])) ? $_POST['option'] : '';
    switch ($option) {
        case 1:
            # code...
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
        
                $start_date =Dates($start_date);
                $end_date =Dates($end_date);
        
                $rows = $model->date_range($start_date, $end_date);
            }
            else{
                
                $rows = $model->fetch();
            }
            break;
        case 2:
            # code...
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
        
                $start_date =Dates($start_date);
                $end_date =Dates($end_date);
        
                $rows = $model->date_rangeGE($start_date, $end_date);
            }
            else{
                
                $rows = $model->fetchGE();
            }
            break;  
            case 3:
                # code...
                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
            
                    $start_date =Dates($start_date);
                    $end_date =Dates($end_date);
            
                    $rows = $model->date_rangeMeteo($start_date, $end_date);
                }
                else{
                    
                    $rows = $model->fetchMeteo();
                }
                break;       
        default:
            # code...
            break;
    }


    echo json_encode($rows);