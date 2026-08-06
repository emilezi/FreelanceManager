<?php

$Mail = new Mail();

if(isset($_POST['submit_email'])){

    $Mail->MailVerification();

        if($Setting->getLanguage() == 'fr'){

                include("public/pages/fr/message/check_email_sent.php");

            }else{

                include("public/pages/en/message/check_email_sent.php");

            }

}