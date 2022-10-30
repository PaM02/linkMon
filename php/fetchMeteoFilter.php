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

         $start_dateGraph =Dates($start_dateGraph);
         $end_dateGraph =Dates($end_dateGraph);

         # code...
         $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
         $toDay = $date->format('Y-m-d');

         $query = " SELECT DATE_FORMAT(TRDate, '%d/%m/%y') AS TRDate,TRHeure,Meteo_Temp,Meteo_Hum,Meteo_Light
         FROM meteo_tempsreel  WHERE `TRDate` >= '$start_dateGraph' AND `TRDate` <= '$end_dateGraph'";
         $statement = $bdd->prepare($query);
         $statement->execute();
         $result = $statement->fetchAll();
         foreach($result as $row){

            $output[] = array(
               'jours'  => $row["TRDate"].' '.$row["TRHeure"],
               'Meteo_Temp'  => $row["Meteo_Temp"],
               'Meteo_Hum'  => $row["Meteo_Hum"],
               'Meteo_Light'  => $row["Meteo_Light"]
            ); 
         }

   echo json_encode($output);
   }

?>