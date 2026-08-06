<?php

require 'class/Form.php';
require 'class/User.php';
require 'class/Mail.php';

$Form = new Form();
$Mail = new Mail();
$User = new User();

if(isset($_POST['submit'])){

    if($Form->checkEmail() == 0){

        if($User->checkUserMail() == 0){

            $Mail->MailRecovery();

            if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/message/recovery_email_sent.php");

            }else{

                include("public/pages/en/message/recovery_email_sent.php");
            }

        }else{

            if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/error/user_not_found.php");

            }else{

                include("public/pages/en/error/user_not_found.php");
            }

        }

    }elseif($Form->checkEmail() == 1){

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