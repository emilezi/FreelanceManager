<?php

$Form = new Form();
$User = new User();

if(isset($_POST['submit_edit_password'])){

    if($Form->checkPassword() == 0){

        $User->setUsersPassword();

    }elseif($Form->checkPassword() == 1){

    if($Setting->getLanguage() == 'fr'){

        include("public/pages/fr/error/password_not_identical.php");

    }else{

        include("public/pages/en/error/password_not_identical.php");

    }

    }else{

    if($Setting->getLanguage() == 'fr'){

        include("public/pages/fr/error/field_not_entered.php");

    }else{

        include("public/pages/en/error/field_not_entered.php");

    }

    }
    
}