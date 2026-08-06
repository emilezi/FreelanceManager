<?php

require 'class/Form.php';
require 'class/CSV.php';

$Form = new Form();
$CSV = new CSV();

if(isset($_POST['submit_csv'])){

    if($Form->checkCSV() == 0){

        $CSV->newCSV($Setting, $Bank);

    }elseif($Form->checkCSV() == 1){

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