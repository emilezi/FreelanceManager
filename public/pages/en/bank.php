<?php

require("class/Bank.php");

$Bank = new Bank();

require("actions/bank/new_csv.php");

$bankinfo = $Bank->getBank();
$annualturnover = $Bank->getAnnualTurnover($Setting);
$turnovermax = $Setting->getTurnoverMax();
$startmonthlydate = $Setting->getMonthlyTaxDateStart();
$endmonthlydate = $Setting->getMonthlyTaxDateEnd();
$startquarterlydate = $Setting->getQuarterlyTaxDateStart();
$endquarterlydate = $Setting->getQuarterlyTaxDateEnd();
$turnoverbic1 = $Bank->getTurnoverBIC1($Setting);
$turnoverbic2 = $Bank->getTurnoverBIC2($Setting);
$turnoverbnc = $Bank->getTurnoverBNC($Setting);
$bic1liberatorypayment = $Bank->getBIC1LiberatoryPayment($Setting);
$bic2liberatorypayment = $Bank->getBIC2LiberatoryPayment($Setting);
$bncliberatorypayment = $Bank->getBNCLiberatoryPayment($Setting);
$liberalprofessionaltraining = $Bank->getLiberalProfessionalTraining($Setting);
$amountbic1 = $Bank->getAmountBIC1($Setting);
$amountbic2 = $Bank->getAmountBIC2($Setting);
$amountbnc = $Bank->getAmountBNC($Setting);
$amountbic1pay = $Bank->getAmountBIC1Pay($Setting);
$amountbic2pay = $Bank->getAmountBIC2Pay($Setting);
$amountbncpay = $Bank->getAmountBNCPay($Setting);
$amountproftraining = $Bank->getAmountProfessionalTraining($Setting);

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
                    <h3>Banque</h3>
                    <p>Cash balance : <?=$bankinfo['treasury']?>€</p>
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
                    <h5>Turnover :</h5>
                    <p>Total annual amount : <?=$annualturnover?>€</p>
                    <p>BIC-1 Amount : <?=$turnoverbic1?>€</p>
                    <p>BIC-2 Amount : <?=$turnoverbic2?>€</p>
                    <p>BNC amount : <?=$turnoverbnc?>€</p>
                    <p>Maximum annual amount  : <?=$turnovermax?>€ excluding tax</p>
                    <?php
                    if($_SESSION['taxation'] === 'month'){
                      echo "<p><b>Start of the next tax period : </b></p>";
                      echo "<p>Date : ".$startmonthlydate."</p>";
                      echo "<p><b>End of the next tax period : </b></p>";
                      echo "<p>Date : ".$endmonthlydate."</p>";
                    }elseif($_SESSION['taxation'] === 'quarterly'){
                      echo "<p><b>Start of the next tax period : </b></p>";
                      echo "<p>Date : ".$startquarterlydate."</p>";
                      echo "<p><b>End of the next tax period : </b></p>";
                      echo "<p>Date : ".$endquarterlydate."</p>";
                    }
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
                    <h5>Charges :</h5>
                    <p>Final withholding payment BIC-1 : <?=$bic1liberatorypayment?>€</p>
                    <p>Final withholding payment BIC-2 : <?=$bic2liberatorypayment?>€</p>
                    <p>Final withholding payment BNC : <?=$bncliberatorypayment?>€</p>
                    <p>Training for self-employed professionals : <?=$liberalprofessionaltraining?>€</p>
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
                    <h5>Current tax rate</h5>
                    <p><b>Merchandise buying and selling activity (BIC-1) : <?=$Setting->getBIC1Rate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbic1?>€</p>
                    <p><b>Commercial and artisanal services (BIC-2) : <?=$Setting->getBIC2Rate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbic2?>€</p>
                    <p><b>Service provision and liberal professions (BNC) : <?=$Setting->getBNCRate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbnc?>€</p>
                    <p><b>Final income tax payment (flat-rate withholding) (Prestations BIC) : <?=$Setting->getBIC1PayRate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbic1pay?>€</p>
                    <p><b>Final income tax payment (flat-rate withholding) (vente BIC) : <?=$Setting->getBIC2PayRate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbic2pay?>€</p>
                    <p><b>Final income tax payment (flat-rate withholding) (Prestations BNC) : <?=$Setting->getBNCPayRate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountbncpay?>€</p>
                    <p><b>Mandatory training for self-employed professionals : <?=$Setting->getProfessionalTrainingRate()?>%</b></p>
                    <p>Amount to be declared : <?=$amountproftraining?>€</p>
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
                    <h5>CSV format</h5>
                    <a class='waves-effect waves-light btn modal-trigger' data-target='modal_csv'>Export to CSV format</a>
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

<div id='modal_csv' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>CSV Export</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='file_name' id='file_name' type='text' class='validate'>
          <label for='file_name'>File name</label>
        </div>
      </div>
      <p><a href="resources/csv/">Location</a></p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-light btn' id='submit_csv' type='submit' name='submit_csv' value='Create' class='validate'>
    </div>
    </form>
</div>