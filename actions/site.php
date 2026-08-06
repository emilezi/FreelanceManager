<?php
/**
    *
    * This file contains all the function calls concerning the verification of the database, the verification of the active user and contains all the redirections of the application
    *
    */

session_start();

include 'public/site/high_page.php';

$Database = new Database();
$Setting = new Setting();

if($Database->setConnection() == 0) {

    if($Database->setDatabase() == 0) {

        if($Database->setTables() == 0) {

			$Session = new Session();

			if($Session->UserSession() == 0) {

				if(!isset($_GET['link'])){
					$_GET['link'] = 'site';
				}

				$link = $_GET['link'];

				if($Setting->getLanguage() == 'fr'){

					include("public/site/fr/nav_bar.php");

				if($_SESSION['type'] == 'admin'){

				switch($link){
					case 'mail_verification':{
						include("public/pages/fr/mail_verification.php");
						break;
					}
					case 'admin':{
						include("public/pages/fr/admin.php");
						break;
					}
					case 'bank':{
						include("public/pages/fr/bank.php");
						break;
					}
					case 'charge':{
						include("public/pages/fr/charge.php");
						break;
					}
					case 'client':{
						include("public/pages/fr/client.php");
						break;
					}
					case 'currency':{
						include("public/pages/fr/currency.php");
						break;
					}
					case 'business':{
						include("public/pages/fr/business.php");
						break;
					}
					case 'service':{
						include("public/pages/fr/service.php");
						break;
					}
					case 'user':{
						include("public/pages/fr/user.php");
						break;
					}
					default :{
						include("public/pages/fr/site.php");
						break;
					}
				}

				}else{

					switch($link){
					case 'mail_verification':{
						include("public/pages/fr/mail_verification.php");
						break;
					}
					case 'bank':{
						include("public/pages/fr/bank.php");
						break;
					}
					case 'charge':{
						include("public/pages/fr/charge.php");
						break;
					}
					case 'client':{
						include("public/pages/fr/client.php");
						break;
					}
					case 'currency':{
						include("public/pages/fr/currency.php");
						break;
					}
					case 'business':{
						include("public/pages/fr/business.php");
						break;
					}
					case 'service':{
						include("public/pages/fr/service.php");
						break;
					}
					case 'user':{
						include("public/pages/fr/user.php");
						break;
					}
					default :{
						include("public/pages/fr/site.php");
						break;
					}
				}

				}

				}else{

					include("public/site/en/nav_bar.php");

				if($_SESSION['type'] == 'admin'){

				switch($link){
					case 'mail_verification':{
						include("public/pages/en/mail_verification.php");
						break;
					}
					case 'admin':{
						include("public/pages/en/admin.php");
						break;
					}
					case 'bank':{
						include("public/pages/en/bank.php");
						break;
					}
					case 'charge':{
						include("public/pages/en/charge.php");
						break;
					}
					case 'client':{
						include("public/pages/en/client.php");
						break;
					}
					case 'currency':{
						include("public/pages/en/currency.php");
						break;
					}
					case 'business':{
						include("public/pages/en/business.php");
						break;
					}
					case 'service':{
						include("public/pages/en/service.php");
						break;
					}
					case 'user':{
						include("public/pages/en/user.php");
						break;
					}
					default :{
						include("public/pages/en/site.php");
						break;
					}
				}

				}else{

					switch($link){
					case 'mail_verification':{
						include("public/pages/en/mail_verification.php");
						break;
					}
					case 'bank':{
						include("public/pages/en/bank.php");
						break;
					}
					case 'charge':{
						include("public/pages/en/charge.php");
						break;
					}
					case 'client':{
						include("public/pages/en/client.php");
						break;
					}
					case 'currency':{
						include("public/pages/en/currency.php");
						break;
					}
					case 'business':{
						include("public/pages/en/business.php");
						break;
					}
					case 'service':{
						include("public/pages/en/service.php");
						break;
					}
					case 'user':{
						include("public/pages/en/user.php");
						break;
					}
					default :{
						include("public/pages/en/site.php");
						break;
					}
				}

				}

				}

				

			}elseif($Session->UserSession() == 1){

				if(!isset($_GET['link'])){
					$_GET['link'] = 'site';
				}

				$link = $_GET['link'];

				if($Setting->getLanguage() == 'fr'){

					switch($link){
						case 'account_recovery':{
							include("public/pages/fr/account_recovery.php");
							break;
						}
						case 'password_recovery':{
							include("public/pages/fr/password_recovery.php");
							break;
						}
						default :{
							include("public/pages/fr/authentication.php");
							break;
						}
					}

				}else{

					switch($link){
						case 'account_recovery':{
							include("public/pages/en/account_recovery.php");
							break;
						}
						case 'password_recovery':{
							include("public/pages/en/password_recovery.php");
							break;
						}
						default :{
							include("public/pages/en/authentication.php");
							break;
						}
					}

					}

			}elseif($Session->UserSession() == 2) {

				session_destroy();

				header('Location: index.php');

			}elseif($Session->UserSession() == 3) {

				session_destroy();

				header('Location: index.php');

			}

		}else{

			if($Setting->getLanguage() == 'fr'){

				include("public/pages/fr/startup/business.php");

			}else{

				include("public/pages/en/startup/business.php");

			}

		}

	}else{

		if($Setting->getLanguage() == 'fr'){

				include("public/pages/fr/startup/database.php");

			}else{

				include("public/pages/en/startup/database.php");

			}

	}

}else{

		if($Setting->getLanguage() == 'fr'){

				include("public/pages/fr/error/connection.php");

			}else{

				include("public/pages/en/error/connection.php");

			}

}

include 'public/site/down_page.php';