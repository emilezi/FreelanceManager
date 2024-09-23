<?php

class Currency extends Database{
    
    protected $currency;

    public function __construct(){
        $this->currency = $_POST;
    }



    public function getCurrency(){

        $db = self::getDatabase();

        $u = $db->prepare("SELECT * FROM User WHERE id=:id");
        $u->execute([
            'id' => $_SESSION['id']
            ]);

        $user = $u->fetch();

        $q = $db->prepare("SELECT * FROM Currency WHERE SIREN=:SIREN");
        $q->execute([
            'SIREN' => $user['SIREN']
        ]);

        $currency_list = null;

        if($q->rowCount() > 0){

            $i = 0;

            while($currency = $q->fetch(PDO::FETCH_ASSOC)){

                $i = $i + 1;

                $currency_list[$i] = $currency;
        
            }
        
        }

        return $currency_list;

    }



    public function addCurrency(){

        $db = self::getDatabase();

        $u = $db->prepare("SELECT * FROM User WHERE id=:id");
        $u->execute([
            'id' => $_SESSION['id']
            ]);

        $user = $u->fetch();

        $q = $db->prepare("INSERT INTO Currency(`SIREN`,`customer_name`,`service_name`,`start_date`,`end_date`,`hours_days`,`number_days`,`documents`,`description`) VALUES(:SIREN,:customer_name,:service_name,:start_date,:end_date,:hours_days,:number_days,:documents,:description)");
        $q->execute([
            'SIREN' => $user['SIREN'],
            'customer_name'=> $this->currency['customer_name'],
            'service_name' => $this->currency['service_name'],
            'start_date' => $this->currency['start_date'],
            'end_date' => $this->currency['end_date'],
            'hours_days' => $this->currency['hours_days'],
            'number_days' => $this->currency['number_days'],
            'documents' => $this->currency['documents'],
            'description' => $this->currency['description']
            ]);

    }



    public function editCurrency(){

    }



    public function deleteCurrency(){
        
    }
    
}