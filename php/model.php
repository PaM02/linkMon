<?php
//23R@bichr@khli1234
class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "linkonmonitoring";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            //throw $th;
            echo "Vérifier votre connexion." . $th->getMessage();
        }
    }

    public function fetch()
    {
        $data = [];
        $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
        $toDay = $date->format('Y-m-d');

        $query = "SELECT  TRId,TRDate,TRHeure,Secteur_1,Secteur_2,Secteur_3,CE_U1,CE_U2,CE_U3,CE_I1,CE_I2,CE_I3,CE_P1,CE_P2,CE_P3,
        CE_FREQUENCE,CE_E1,CE_E2,CE_E3,CE_E FROM ce_tempsreel where TRDate ='".$toDay."'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function fetchGE()
    {
        $data = [];
        $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
        $toDay = $date->format('Y-m-d');

        $query = "SELECT  * FROM GE_tempsreel where TRDate ='".$toDay."'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function fetchMeteo()
    {
        $data = [];
        $date = new DateTime("now", new DateTimeZone('Africa/Dakar'));
        $toDay = $date->format('Y-m-d');

        $query = "SELECT  * FROM meteo_tempsreel where TRDate ='".$toDay."'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function date_range($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT TRId,TRDate,TRHeure,Secteur_1,Secteur_2,Secteur_3,CE_U1,CE_U2,CE_U3,CE_I1,CE_I2,CE_I3,CE_P1,CE_P2,CE_P3,
            CE_FREQUENCE,CE_E1,CE_E2,CE_E3,CE_E FROM `ce_tempsreel` WHERE `TRDate` >= '$start_date' AND `TRDate` <= '$end_date'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }

    public function date_rangeGE($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM `GE_tempsreel` WHERE `TRDate` >= '$start_date' AND `TRDate` <= '$end_date'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }

    public function date_rangeMeteo($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM `meteo_tempsreel` WHERE `TRDate` >= '$start_date' AND `TRDate` <= '$end_date'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}