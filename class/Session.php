<?php

class Session extends Database{
    
    public function UserSession(){

        $db = self::getDatabase();

        if
        (
            isset($_SESSION['id'])
            &&
            isset($_SESSION['type'])
            &&
            isset($_SESSION['first_name'])
            &&
            isset($_SESSION['last_name'])
            &&
            isset($_SESSION['identifier'])
            &&
            isset($_SESSION['email'])
            &&
            isset($_SESSION['phone'])
            &&
            isset($_SESSION['user_key'])
        )
        {

            $q = $db->prepare("SELECT * FROM User WHERE id=:id AND type=:type");
            $q->execute([
            'id' => $_SESSION['id'],
            'type' => $_SESSION['type']
            ]);

            $user = $q->fetch();

            if($user == TRUE){

                return 0;

            }else{

                return 3;

            }
        
        
        }
        elseif
        (
        isset($_SESSION['id'])
        ||
        isset($_SESSION['type'])
        ||
        isset($_SESSION['first_name'])
        ||
        isset($_SESSION['last_name'])
        ||
        isset($_SESSION['identifier'])
        ||
        isset($_SESSION['email'])
        ||
        isset($_SESSION['phone'])
        &&
        isset($_SESSION['user_key'])
        )
        {

            return 2;

        }else{

            return 1;

        }

    }
    
}