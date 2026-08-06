<?php

require 'class/Form.php';
require 'class/User.php';

$Form = new Form();
$User = new User();

if(isset($_POST['submit'])){

    if($Form->newUser() == 0){

        if($Form->checkPassword() == 0){

            $Database -> newTables();

            $Database -> setSetting();

            $User -> firstUser();

            $User -> UserLogin();

            header('Location: index.php');

        }else{

            if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/error/password_not_identical.php");

            }else{

                include("public/pages/en/error/password_not_identical.php");

            }

        }

    }elseif($Form->newUser() == 1){

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