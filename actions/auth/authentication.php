<?php

require 'class/Form.php';
require 'class/User.php';

$Form = new Form();
$User = new User();

if(isset($_POST['submit'])){

    if($Form->Authentication() == 0){

        if($User -> UserLogin() == 0){

            header("Location: index.php");

        }elseif($User -> UserLogin() == 1){

        if($Setting->getLanguage() == 'fr'){

            include("public/pages/fr/error/incorrect_password.php");

        }else{

            include("public/pages/en/error/incorrect_password.php");
        }

        }else{

        if($Setting->getLanguage() == 'fr'){

            include("public/pages/fr/error/user_not_found.php");

        }else{

            include("public/pages/en/error/user_not_found.php");
        }

        }

    }elseif($Form->Authentication() == 1){

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