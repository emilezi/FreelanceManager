<?php

$User = new User();

if(isset($_POST['submit_delete'])){

    if($User->checkUserType() == 0){

        $User->deleteUser();

        session_destroy();

        header('Location: index.php');

    }else{

        if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/error/user_delete.php");

            }else{

                include("public/pages/en/error/user_delete.php");

            }
    
    }

}