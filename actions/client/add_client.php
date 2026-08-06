<?php

require 'class/Form.php';

$Form = new Form();

if(isset($_POST['submit'])){

    if($Form->checkClient() == 0){

        $Client->addClient();

    }elseif($Form->checkClient() == 1){

        if($Setting->getLanguage() == 'fr'){

            include("public/pages/fr/error/invalid_special_character.php");

        }else{

            include("public/pages/en/error/invalid_special_character.php");
        }

    }else{

        if($Setting->getLanguage() == 'fr'){

            include("public/pages/fr/error/field_not_entered.php");

        }else{

            include("public/pages/en/error/field_not_entered.php");
        }

    }
    
}