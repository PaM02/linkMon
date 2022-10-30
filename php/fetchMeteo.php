<?php

//fetch.php

include('bdd.php');

if(isset($_POST["selectItems"]))
{
      # code...
      $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
      $toDay = $date->format('Y-m-d');

      $query = " SELECT DATE_FORMAT(TRDate, '%d/%m/%y') AS TRDate,TRHeure,Meteo_Temp,Meteo_Hum,Meteo_Light
       FROM meteo_tempsreel where TRDate ='".$toDay."'";
      $statement = $bdd->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row)
     
      {

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