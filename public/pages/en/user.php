<?php

require 'class/Form.php';
require 'class/User.php';
require 'class/Mail.php';

require("actions/user/check_mail.php");
require("actions/user/user_delete.php");
require("actions/user/user_disconnect.php");
require("actions/user/user_edit_password.php");
require("actions/user/user_edit.php");

$User = new User();

$user = $User->getUser();

?>

<div class="container">
    <div class="section">
      
    <div class="row">

        <div class="col s12 m12">
        <div class="icon-block">

        <div class='offset-m2 l6 offset-l3'>
          <div class='card-panel grey lighten-5 z-depth-1'>
            <div class='row valign-wrapper'>
              <div class='col s12'>
                <span class='black-text'>
                  <h3><?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></h3>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class='offset-m2 l6 offset-l3'>
          <div class='card-panel grey lighten-5 z-depth-1'>
            <div class='row valign-wrapper'>
              <div class='col s12'>
                <span class='black-text'>
                    <h5>Personal information</h5>
                    <p><b>SIREN number :</b> <?=$_SESSION['SIREN']?></p>
                    <p><b>SIRET number :</b> <?=$_SESSION['SIRET']?></p>
                    <?php
                    if($_SESSION['status'] === 'ei'){
                      echo '<p><b>Legal status :</b> EI (Sole proprietor)</p>';
                    }elseif($_SESSION['status'] === 'eurl'){
                      echo '<p><b>Legal status :</b> EURL (Single-member limited liability company; option to convert to a standard limited liability company SARL)</p>';
                    }else{
                      echo '<p><b>Legal status :</b> Null</p>';
                    }
                    ?>
                    <p><b>Company founding date :</b> <?=$_SESSION['date_creation']?></p>
                    <?php
                    if($_SESSION['taxation'] === 'month'){
                      echo "<p><b>Taxation period :</b> Every month</p>";
                    }elseif($_SESSION['taxation'] === 'quarterly'){
                      echo "<p><b>Taxation period :</b> Quarterly</p>";
                    }else{
                      echo "<p><b>Taxation period :</b> Null</p>";
                    }
                    ?>
                    <p><b>Identifier :</b> <?=$_SESSION['identifier']?></p>
                    <p><b>Email :</b> <?=$user['email']?></p>
                    <?php
                    if($user['email_checked'] === "false"){
                      echo "<form class='col s6' method='post'>
                      <input class='waves-effect waves-green btn' id='submit_email' type='submit' name='submit_email' value='Check' class='validate'>
                      </form>";
                    }else{
                      echo "<p>L'adresse e-mail a été vérifiée avec succès.</p>";
                    }
                    ?>
                    <br/><br/>
                    <p><b>Phone :</b> <?=$user['phone']?></p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_password'>Change password</a><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_disconnect'>Log out</a>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class='offset-m2 l6 offset-l3'>
          <div class='card-panel grey lighten-5 z-depth-1'>
            <div class='row valign-wrapper'>
              <div class='col s12'>
                <span class='black-text'>
                    <h5>Other actions</h5>
                    <a class='waves-effect waves-light btn red modal-trigger' data-target='modal_delete'>Delete my account</a>
                </span>
              </div>
            </div>
          </div>
        </div>
            
        </div>
        </div>
    
    </div>

    </div>
</div>

<div id='modal_disconnect' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Log out</h4>
      <p>Are you sure you want to log out ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_logout' type='submit' name='submit_logout' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    </form>
</div>

<div id='modal_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>Edit profile</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='email' id='email' type='text' value='<?=$user['email']?>' class='validate'>
          <label for='email'>E-mail address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='phone' id='phone' type='text' value='<?=$user['phone']?>' class='validate'>
          <label for='phone'>Phone number</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='Edit profile' class='validate'>
      </div>
    </form>
</div>

<div id='modal_edit_password' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>Change password</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='password' id='password' type='password' class='validate'>
          <label for='password'>Password</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='repassword' id='repassword' type='password' class='validate'>
          <label for='repassword'>Re-enter the password</label>
        </div>
      </div>
      </div>
      <div class='modal-footer'>
          <input class='waves-effect waves-light btn' id='submit_edit_password' type='submit' name='submit_edit_password' value='Change password' class='validate'>
        </div>
    </form>
</div>

<div id='modal_delete' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Account deletion</h4>
      <p>Are you sure you want to delete the account ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_delete' type='submit' name='submit_delete' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    </form>
    </div>