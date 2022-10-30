<?php

//fetch.php

include('bdd.php');

if(isset($_POST["selectItems"]))
{
      # code...
      $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
      $toDay = $date->format('Y-m-d');

      $query = " SELECT DATE_FORMAT(TRDate, '%d/%m/%Y') AS TRDate,GETension_Batt,GETemp_Moteur,GEVitesse_Moteur,GEPression_Huile,GEEtat_du_Moteur,
      GETension_L1_N,GEFrequence,GECourant_Phase1,GE_Heures,GE_Energie FROM ge_tempsreel where TRDate ='".$toDay."' ";
      $statement = $bdd->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row){

         $output[] = array(
         'jours'  => $row["TRDate"],
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