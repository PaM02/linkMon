<?php

   //fetch.php

   include('bdd.php');

   function Dates($date){

      $jour=substr($date,0,2);
      $mois =substr($date,3,2);
      $annee = substr($date,6,4);
      $formatAnglais = $annee.'-'.$mois.'-'.$jour;
      return $formatAnglais;
   }

   if(isset($_POST["selectItemsGraph"]) && isset($_POST["start_dateGraph"]) && isset($_POST["end_dateGraph"]))
   {
         $start_dateGraph = $_POST['start_dateGraph'];
         $end_dateGraph = $_POST['end_dateGraph'];
         # code...
         
         $start_dateGraph =Dates($start_dateGraph);
         $end_dateGraph =Dates($end_dateGraph);

         $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
         $toDay = $date->format('Y-m-d');

         $query = " SELECT DATE_FORMAT(TRDate, '%d/%m/%Y') AS TRDate,TRHeure,GETension_Batt,GETemp_Moteur,GEVitesse_Moteur,GEPression_Huile,GEEtat_du_Moteur,
         GETension_L1_N,GEFrequence,GECourant_Phase1,GE_Heures,GE_Energie FROM ge_tempsreel  WHERE `TRDate` >= '$start_dateGraph' AND `TRDate` <= '$end_dateGraph'";
         $statement = $bdd->prepare($query);
         $statement->execute();
         $result = $statement->fetchAll();
         foreach($result as $row){

            $output[] = array(
               'jours'  => $row["TRDate"],
               'heure'  => $row["TRHeure"],
               'GETension_Batt'  => floatval($row["GETension_Batt"]),
               'GETemp_Moteur'  => $row["GETemp_Moteur"],
               'GEVitesse_Moteur'  => $row["GEVitesse_Moteur"],
               'GEPression_Huile'  => $row["GEPression_Huile"],
               'GEEtat_du_Moteur'  => $row["GEEtat_du_Moteur"],
               'GETension_L1_N'  => $row["GETension_L1_N"],
               'GEFrequence'  => $row["GEFrequence"],
               'GECourant_Phase1'  => $row["GECourant_Phase1"],
               'GE_Heures'  => floatval($row["GE_Heures"]),
               'GE_Energie'  => floatval($row["GE_Energie"])
            ); 
         }

   echo json_encode($output);
   }

?>