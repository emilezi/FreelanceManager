<?php

$Form = new Form();
$User = new User();

if(isset($_POST['submit_edit'])){

    if($Form->editUser() == 0){

        if($User->checkEmailPhoneUser() == 0){

            $User->editUser();

        }else{

            if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/error/user_already_email_phone_exists.php");

            }else{

                include("public/pages/en/error/user_already_email_phone_exists.php");

            }

        }

    }elseif($Form->editUser() == 1){

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