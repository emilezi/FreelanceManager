<?php
require("class/Bank.php");
require("class/Client.php");
require("class/Service.php");
require("class/Currency.php");

$Bank = new Bank();
$Client = new Client();
$Service = new Service();
$Currency = new Currency();

$date_array = getdate();
$date = $date_array['year']."-".$date_array['mon']."-".$date_array['mday']." min=".$date_array['year']."-".$date_array['mon']."-".$date_array['mday'];

require("actions/currency/add_quote.php");
require("actions/currency/cancel_quote.php");
require("actions/currency/pay_quote.php");

echo "<table>
    <thead><tr>
        <th>Client name</th>
        <th>Service name</th>
        <th>Start date :</th>
        <th>End date :</th>
        <th>Price excl. tax :</th>
        <th>Created on :</th>
        <th>Action :</th>
    </tr></thead>
    <tbody>";

if($Currency->getCurrency() != null){

  $i = 0;

    foreach ($Currency->getCurrency() as $currency) {

        $i = $i + 1;
        
        echo "<tr>
        <td>".$currency['customer_name']."</td>
        <td>".$currency['service_name']."</td>
        <td>".$currency['start_date']."</td>
        <td>".$currency['end_date']."</td>
        <td>".$currency['price_ht']."€</td>
        <td>".$currency['date']."</td>";
        if($currency['state'] === 'unpaid'){
          echo "<td><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_cancel_".$i."'>Cancel the invoice</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_validation_".$i."'>Complete the payment</a></td>";
        }else{
          echo "<td><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a></td>";
        }
        echo "<td></td>
        </tr>";

    }

}else{

    echo "<tr>
    <td>No invoice for the moment.</td>
    </tr>";

}

echo "</tbody>
    </table>";

if($Currency->getCurrency() != null){

  $i = 0;

    foreach($Currency->getCurrency() as $currency) {

      $i = $i + 1;

      echo "<div id='modal_cancel_".$i."' class='modal modal-fixed-footer'>
      <form class='col s6' method='post'>
      <div class='modal-content'>
        <h4>Cancel the selected invoice</h4>
        <p>Are you sure you want to cancel the selected invoice ?</p>
      </div>
      <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_cancel' type='submit' name='submit_cancel' value='Yes' class='validate'>
          <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
      </div>
      <input id='value' type='hidden' name='value' value=".$currency['id'].">
      </form>
      </div>";
      
      echo "<div id='modal_description_".$i."' class='modal modal-fixed-footer'>
      <div class='modal-content'>
        <h4>Invoice information</h4>
        <br/>
        <h6><b>Client name : </b>".$currency['customer_name']."</h6>
        <br/>
        <h6><b>Service name : </b>".$currency['service_name']."</h6>
        <br/>
        <h6><b>Start date : </b>".$currency['start_date']."</h6>
        <br/>
        <h6><b>End date : </b>".$currency['end_date']."</h6>
        <br/>
        <h6><b>Price excl. tax : </b>".$currency['price_ht']."€</h6>
        <br/>
        <h6><b>Number of hours/day : </b>".$currency['hours_days']."</h6>
        <br/>
        <h6><b>Number of days : </b>".$currency['number_days']."</h6>
        <br/>
        <h6><b>Status : </b>";
        if($currency['state'] === 'paid'){
          echo "Paid";
        }elseif($currency['state'] === 'unpaid'){
          echo "Unpaid";
        }elseif($currency['state'] === 'cancel'){
          echo "Canceled";
        }
        echo "</h6>
        <br/>
        <h6><b>Description :</b></h6>
        <p>".$currency['description']."</p>
      </div>
      </div>";

        echo "<div id='modal_validation_".$i."' class='modal modal-fixed-footer'>
        <form class='col s6' method='post'>
        <div class='modal-content'>
          <h4>Payment validation</h4>
          <p>Are you sure you want to confirm the selected payment ?</p>
          <p>All payment confirmations will be final !</p>
        </div>
        <div class='modal-footer'>
            <input class='waves-effect waves-green btn' id='submit_pay' type='submit' name='submit_pay' value='Yes' class='validate'>
            <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
        </div>
        <input id='value' type='hidden' name='value' value=".$currency['id'].">
        </form>
        </div>";

    }

}

echo "<a class='btn btn-floating btn-large waves-effect waves-light red'><i data-target='modal_new' class='material-icons modal-trigger'>add</i></a>";

echo "<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>New invoice</h4>";
echo "<div class='row'>
    <div class='input-field col s12'>
    <select name='customer_name'>";
    if($Client->getClient() != null){
        echo "<option disabled selected>Client name</option>";
      foreach ($Client->getClient() as $client) {
        echo "<option value='".$client['name']."'>".$client['name']."</option>";
      }
    }else{
      echo "<option disabled selected>No client</option>";
    }
echo "</select>
    <label>Client name</label>
    </div>
    </div>
    <div class='row'>
    <div class='input-field col s12'>
    <select name='service_name'>";
    if($Service->getService() != null){
        echo "<option disabled selected>Service name</option>";
      foreach ($Service->getService() as $service) {
        echo "<option value='".$service['name']."'>".$service['name']."</option>";
      }
    }else{
      echo "<option disabled selected>No service</option>";
    }
echo "</select>
    <label>Name of the associated service</label>
    </div>
    </div>";
echo "<div class='row'>
        <div class='input-field col s12'>
          <input name='start_date' id='start_date' type='date' value=".$date.">
          <label for='start_date'>Start date</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='end_date' id='end_date' type='date' value=".$date.">
          <label for='end_date'>End date</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='hours_days' id='hours_days' type='time' min='00:00' max='12:00' value='00:00'>
          <label for='hours_days'>Number of hours per day</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='number_days' id='number_days' type='number' class='validate'>
          <label for='number_days'>Number of days</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <textarea name='description' id='description' class='materialize-textarea'></textarea>
          <label for='description'>Invoice description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='modal-close waves-effect waves-green btn' id='submit' type='submit' name='submit' value='Create the invoice' class='validate'>
      </div>
    </form>
    </div>";