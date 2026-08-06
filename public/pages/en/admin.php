<?php

require("class/Form.php");
require("class/User.php");

$User = new User();

require("actions/admin/user/new_user.php");
require("actions/admin/user/delete_user.php");
require("actions/admin/user/edit_password_user.php");
require("actions/admin/user/edit_user.php");
require("actions/admin/interface/reset.php");
require("actions/admin/date/edit_monthly_start.php");
require("actions/admin/date/edit_monthly_end.php");
require("actions/admin/date/edit_quarterly_start.php");
require("actions/admin/date/edit_quarterly_end.php");
require("actions/admin/rate/edit_bic1_rate.php");
require("actions/admin/rate/edit_bic2_rate.php");
require("actions/admin/rate/edit_bnc_rate.php");
require("actions/admin/rate/edit_bic1_pay.php");
require("actions/admin/rate/edit_bic2_pay.php");
require("actions/admin/rate/edit_bnc_pay.php");
require("actions/admin/rate/edit_protraining_rate.php");

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
                  <h3>Administration</h3>
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
                    <h5>Users</h5>
                    <?php
                    $i = 0;

                    foreach($User->getUsers() as $user) {

                    $i = $i + 1;

                    echo "<h5><b>".$user['first_name']." ".$user['last_name']."</b></h5>";
                    
                    if($user['type'] === 'admin'){
                      echo '<p><b>Account type :</b> Administrator</p>';
                    }elseif($user['type'] === 'user'){
                      echo '<p><b>Account type :</b> User</p>';
                    }else{
                      echo '<p><b>Account type :</b> Useless</p>';
                    }
                    echo "<p><b>N° SIREN :</b> ".$user['SIREN']."</p>
                    <p><b>N° SIRET number :</b> ".$user['SIRET']."</p>";
                    if($user['status'] === 'ei'){
                      echo '<p><b>Legal status :</b> EI (Sole proprietor)</p>';
                    }elseif($user['status'] === 'eurl'){
                      echo '<p><b>Legal status :</b> EURL (Single-member limited liability company, option to convert to a SARL)</p>';
                    }else{
                      echo '<p><b>Legal status :</b> Useless</p>';
                    }
                    echo "<p><b>Company founding date :</b> ".$user['date_creation']."</p>";
                    if($user['taxation'] === 'month'){
                      echo "<p><b>Taxation period :</b> Every month</p>";
                    }elseif($user['taxation'] === 'quarterly'){
                      echo "<p><b>Taxation period :</b> Quarterly</p>";
                    }else{
                      echo "<p><b>Taxation period :</b> Useless</p>";
                    }
                    echo "<p><b>Identifier :</b> ".$user['identifier']."</p>
                    <p><b>Email :</b> ".$user['email']."</p>
                    <p><b>Phone :</b> ".$user['phone']."</p>";

                    echo "<tr>
                    <td><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_".$i."'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_password_".$i."'>Change password</a><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_delete_".$i."'>Delete</a></td>
                    </tr>";

                    echo "<br/><br/>";

                    }

                    echo "<a class='waves-effect waves-light btn modal-trigger' data-target='modal_new'>Start a new business</a>";

                    ?>
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
                    <h5>Dates of upcoming tax payments</h5>
                    <p>Start date of the monthly declaration : <?=$Setting->getMonthlyTaxDateStart()?></p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_monthly_start_edit'>To modify</a>
                    <p>Monthly declaration end date : <?=$Setting->getMonthlyTaxDateEnd()?></p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_monthly_end_edit'>To modify</a>
                    <p>Quarterly start date : <?=$Setting->getQuarterlyTaxDateStart()?></p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_quarterly_start_edit'>To modify</a>
                    <p>Quarterly end date : <?=$Setting->getQuarterlyTaxDateEnd()?></p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_quarterly_end_edit'>To modify</a>
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
                    <h5>Tax rate on activities (%)</h5>
                    <p>For legal reasons, the rates must comply with the micro-entrepreneur status.</p>
                    <p>Modifications are permitted exclusively in the event of a change necessitated by a change in status.</p>
                    <p>Merchandise buying and selling activity (BIC-1) : <?=$Setting->getBIC1Rate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bic1_edit'>To modify</a>
                    <p>Commercial and artisanal services (BIC-2) : <?=$Setting->getBIC2Rate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bic2_edit'>To modify</a>
                    <p>Service provision and liberal professions (BNC) : <?=$Setting->getBNCRate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bnc_edit'>To modify</a>
                    <p>Final income tax payment (flat-rate withholding) (BIC Services) : <?=$Setting->getBIC1PayRate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bic1_pay_edit'>To modify</a>
                    <p>Final income tax payment (flat-rate withholding) (BIC sale) : <?=$Setting->getBIC2PayRate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bic2_pay_edit'>To modify</a>
                    <p>Final income tax payment (flat-rate withholding) (Non-commercial services (BNC)) : <?=$Setting->getBNCPayRate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_bnc_pay_edit'>To modify</a>
                    <p>Mandatory training for self-employed professionals : <?=$Setting->getProfessionalTrainingRate()?>%</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_professional_training_edit'>To modify</a>
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
                    <h5>Reset</h5>
                    <p>Reset interface settings to factory defaults</p>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_reset'>Reset settings</a>
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

<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Start a new business</h4>
      <div class='row'>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='first_name' id='first_name' type='text' class='validate'>
            <label for='first_name'>First name</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='last_name' id='last_name' type='text' class='validate'>
            <label for='last_name'>Last name</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='identifier' id='identifier' type='text' class='validate'>
            <label for='identifier'>Identifier</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='email' id='email' type='email' class='validate'>
            <label for='email'>Email</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='phone' id='phone' type='tel' class='validate'>
            <label for='phone'>Phone</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
          <select name='status'>
            <option value='ei' selected>EI (Sole proprietor, formerly known as EIRL)</option>
            <option value='eurl'>EURL (Single-member limited liability company; option to convert to a standard limited liability company (SARL))</option>
          </select>
          <label>Status</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='SIREN' id='SIREN' type='text' class='validate'>
            <label for='SIREN'>SIREN</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='SIRET' id='SIRET' type='text' class='validate'>
            <label for='SIRET'>SIRET</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='date_creation' id='date_creation' type='date' class='validate'>
            <label for='date_creation'>Company founding date</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
          <select name='taxation'>
            <option value='month' selected>Every month</option>
            <option value='quarterly'>Quarterly</option>
          </select>
          <label>Imposition</label>
          </div>
        </div>
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
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_new' type='submit' name='submit_new' value='Create the profile' class='validate'>
    </div>
    </form>
</div>

<?php
$i = 0;

foreach($User->getUsers() as $user) {

$i = $i + 1;

echo "<div id='modal_edit_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>Edit profile</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='email' id='email' type='text' value='".$user['email']."' class='validate'>
          <label for='email'>E-mail address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='phone' id='phone' type='text' value='".$user['phone']."' class='validate'>
          <label for='phone'>Phone number</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='Edit profile' class='validate'>
      </div>
      <input id='value' type='hidden' name='value' value=".$user['id'].">
    </form>
</div>";

echo "<div id='modal_edit_password_".$i."' class='modal modal-fixed-footer'>
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
      <input id='value' type='hidden' name='value' value=".$user['id'].">
    </form>
</div>";

echo "<div id='modal_delete_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>User deletion</h4>
      <p>Are you sure you want to delete the selected user ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_delete' type='submit' name='submit_delete' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    <input id='value' type='hidden' name='value' value=".$user['id'].">
    </form>
    </div>";

}
?>

<div id='modal_monthly_start_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Change the start date</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='monthly_date_start' id='monthly_date_start' type='date' value='<?=$Setting->getMonthlyTaxDateStart()?>' class='validate'>
          <label for='monthly_date_start'>Start date</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_monthly_date_start_edit' type='submit' name='submit_monthly_date_start_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_monthly_end_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Change the end date</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='monthly_date_end' id='monthly_date_end' type='date' value='<?=$Setting->getMonthlyTaxDateEnd()?>' class='validate'>
          <label for='monthly_date_end'>End date</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_monthly_date_end_edit' type='submit' name='submit_monthly_date_end_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_quarterly_start_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Change the start date</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='quarterly_date_start' id='quarterly_date_start' type='date' value='<?=$Setting->getQuarterlyTaxDateStart()?>' class='validate'>
          <label for='quarterly_date_start'>Start date</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_quarterly_date_start_edit' type='submit' name='submit_quarterly_date_start_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_quarterly_end_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Change the end date</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='quarterly_date_end' id='quarterly_date_end' type='date' value='<?=$Setting->getQuarterlyTaxDateEnd()?>' class='validate'>
          <label for='quarterly_date_end'>End date</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_quarterly_date_end_edit' type='submit' name='submit_quarterly_date_end_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bic1_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bic_1_rate' id='bic_1_rate' type='text' value='<?=$Setting->getBIC1Rate()?>' class='validate'>
          <label for='bic_1_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bic1_rate_edit' type='submit' name='submit_bic1_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bic2_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bic_2_rate' id='bic_2_rate' type='text' value='<?=$Setting->getBIC2Rate()?>' class='validate'>
          <label for='bic_2_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bic2_rate_edit' type='submit' name='submit_bic2_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bnc_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bnc_rate' id='bnc_rate' type='text' value='<?=$Setting->getBNCRate()?>' class='validate'>
          <label for='bnc_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bnc_rate_edit' type='submit' name='submit_bnc_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bic1_pay_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bic_pay_1_rate' id='bic_pay_1_rate' type='text' value='<?=$Setting->getBIC1PayRate()?>' class='validate'>
          <label for='bic_pay_1_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bic1_pay_rate_edit' type='submit' name='submit_bic1_pay_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bic2_pay_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bic_pay_2_rate' id='bic_pay_2_rate' type='text' value='<?=$Setting->getBIC2PayRate()?>' class='validate'>
          <label for='bic_pay_2_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bic2_pay_rate_edit' type='submit' name='submit_bic2_pay_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_bnc_pay_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='bnc_pay_rate' id='bnc_pay_rate' type='text' value='<?=$Setting->getBNCPayRate()?>' class='validate'>
          <label for='bnc_pay_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_bnc_pay_rate_edit' type='submit' name='submit_bnc_pay_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_professional_training_edit' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Modify the tax rate</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='professional_training_rate' id='professional_training_rate' type='text' value='<?=$Setting->getProfessionalTrainingRate()?>' class='validate'>
          <label for='professional_training_rate'>Tax rate in %</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_protraining_rate_edit' type='submit' name='submit_protraining_rate_edit' value='To modify' class='validate'>
    </div>
    </form>
</div>

<div id='modal_reset' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Reset settings</h4>
      <p>Are you sure you want to reset the interface settings to factory defaults ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_reset' type='submit' name='submit_reset' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    </form>
</div>