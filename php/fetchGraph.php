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

         $query = " SELECT DATE_FORMAT(TRDate, '%d/%m/%Y') AS TRDate,TRHeure,Secteur_1,Secteur_2,Secteur_3,CE_U1,CE_U2,CE_U3,CE_I1,CE_I2,CE_I3,CE_P1,CE_P2,CE_P3,
            CE_FREQUENCE,CE_E1,CE_E2,CE_E3,CE_E FROM ce_tempsreel  WHERE `TRDate` >= '$start_dateGraph' AND `TRDate` <= '$end_dateGraph'";
         $statement = $bdd->prepare($query);
         $statement->execute();
         $result = $statement->fetchAll();
         foreach($result as $row){

            $output[] = array(
            'jours'  => $row["TRDate"],
            'heure'  => $row["TRHeure"],
            'secteur1'  => $row["Secteur_1"],
            'secteur2'  => $row["Secteur_2"],
            'secteur3'  => $row["Secteur_3"],
            'tension1'  => floatval($row["CE_U1"]),
            'tension2'  => floatval($row["CE_U2"]),
            'tension3'  => floatval($row["CE_U3"]),
            'courant1'  => floatval($row["CE_I1"]),
            'courant2'  => floatval($row["CE_I2"]),
            'courant3'  => floatval($row["CE_I3"]),
            'puissance1'  => floatval($row["CE_P1"]),
            'puissance2'  => floatval($row["CE_P2"]),
            'puissance3'  => floatval($row["CE_P3"]),
            'frequence'  => floatval($row["CE_FREQUENCE"]),
            'energie1'  => floatval($row["CE_E1"]),
            'energie2'  => floatval($row["CE_E2"]),
            'energie3'  => floatval($row["CE_E3"]),
            'energie'  => floatval($row["CE_E"])
            ); 
         }

   echo json_encode($output);
   }

?>