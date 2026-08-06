<?php
require("class/Business.php");

$Business = new Business();

require("actions/business/add_business.php");
require("actions/business/edit_business.php");
require("actions/business/remove_business.php");

echo "<table>
    <thead><tr>
        <th>Company name</th>
        <th>Trade name</th>
        <th>SIRET number</th>
        <th>VAT number</th>
        <th>Country</th>
        <th>Added on :</th>
        <th>Action :</th>
    </tr></thead>
    <tbody>";

if($Business->getBusiness() != null){

  $i = 0;

    foreach($Business->getBusiness() as $business) {

      $i = $i + 1;
        
        echo "<tr>
        <td>".$business['company_name']."</td>
        <td>".$business['trade_name']."</td>
        <td>".$business['SIRET']."</td>
        <td>".$business['vat_number']."</td>
        <td>";
        if($business['country'] === 'germany'){
          echo 'Germany';
        }elseif($business['country'] === 'belgium'){
          echo 'Belgium';
        }elseif($business['country'] === 'canada'){
          echo 'Canada';
        }elseif($business['country'] === 'espagne'){
          echo 'Spain';
        }elseif($business['country'] === 'united_states'){
          echo 'United States';
        }elseif($business['country'] === 'france'){
          echo 'France';
        }elseif($business['country'] === 'italy'){
          echo 'Italy';
        }elseif($business['country'] === 'luxembourg'){
          echo 'Luxembourg';
        }elseif($business['country'] === 'malta'){
          echo 'Malta';
        }elseif($business['country'] === 'netherlands'){
          echo 'Netherlands';
        }elseif($business['country'] === 'portugal'){
          echo 'Portugal';
        }elseif($business['country'] === 'united_kingdom'){
          echo 'United Kingdom';
        }
        echo "</td>
        <td>".$business['date']."</td>
        <td><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_delete_".$i."'>Delete</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_".$i."'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a></td>
        </tr>";

    }

}else{

    echo "<tr>
        <td>No company at the moment</td>
        </tr>";

}

echo "</tbody>
    </table>";

if($Business->getBusiness() != null){

  $i = 0;
    
  foreach($Business->getBusiness() as $business) {

    $i = $i + 1;

    echo "<div id='modal_delete_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Deletion of the company</h4>
      <p>Are you sure you want to delete the selected company ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_delete' type='submit' name='submit_delete' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    <input id='value' type='hidden' name='value' value=".$business['id'].">
    </form>
    </div>";

    echo "<div id='modal_edit_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>Edit the company</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='company_name' id='company_name' type='text' value='".$business['company_name']."' class='validate'>
          <label for='company_name'>Company name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='trade_name' id='trade_name' type='text' value='".$business['trade_name']."' class='validate'>
          <label for='trade_name'>Trade name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='SIRET' id='SIRET' type='text' value='".$business['SIRET']."' class='validate'>
          <label for='SIRET'>SIRET number</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='vat_number' id='vat_number' type='text' value='".$business['vat_number']."' class='validate'>
          <label for='vat_number'>VAT number</label>
        </div>
      </div>
      <input type='hidden' name='country' value=".$business['country'].">
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address' id='address' type='text' value='".$business['address']."' class='validate'>
          <label for='address'>Company address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address_supplement' id='address_supplement' type='text' value='".$business['address_supplement']."' class='validate'>
          <label for='address_supplement'>Address supplement</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='postal_code' id='postal_code' type='text' value='".$business['postal_code']."' class='validate'>
          <label for='postal_code'>Postal code</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='city' id='city' type='text' value='".$business['city']."' class='validate'>
          <label for='city'>City</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <textarea name='description' id='description' class='materialize-textarea'>".$business['description']."</textarea>
          <label for='description'>Company Description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='To modify' class='validate'>
      </div>
    <input id='value' type='hidden' name='value' value=".$business['id'].">
    </form>
    </div>";

    echo "<div id='modal_description_".$i."' class='modal modal-fixed-footer'>
    <div class='modal-content'>
      <h4>Company Information</h4>
      <br/>
      <h6><b>Company name : </b>".$business['company_name']."</h6>
      <br/>
      <h6><b>Trade name : </b>".$business['trade_name']."</h6>
      <br/>
      <h6><b>SIRET number : </b>".$business['SIRET']."</h6>
      <br/>
      <h6><b>VAT number : </b>".$business['vat_number']."</h6>
      <br/>
      <h6>";
      if($business['country'] === 'germany'){
        echo '<p><b>Country : </b> Germany</p>';
      }elseif($business['country'] === 'belgium'){
        echo '<p><b>Country : </b> Belgium</p>';
      }elseif($business['country'] === 'canada'){
        echo '<p><b>Country : </b> Canada</p>';
      }elseif($business['country'] === 'espagne'){
        echo '<p><b>Country : </b> Spain</p>';
      }elseif($business['country'] === 'united_states'){
        echo '<p><b>Country : </b> United States</p>';
      }elseif($business['country'] === 'france'){
        echo '<p><b>Country : </b> France</p>';
      }elseif($business['country'] === 'italy'){
        echo '<p><b>Country : </b> Italy</p>';
      }elseif($business['country'] === 'luxembourg'){
        echo '<p><b>Country : </b> Luxembourg</p>';
      }elseif($business['country'] === 'malta'){
        echo '<p><b>Country : </b> Malta</p>';
      }elseif($business['country'] === 'netherlands'){
        echo '<p><b>Country : </b> Netherlands</p>';
      }elseif($business['country'] === 'portugal'){
        echo '<p><b>Country : </b> Portugal</p>';
      }elseif($business['country'] === 'united_kingdom'){
        echo '<p><b>Country : </b> United Kingdom</p>';
      }
      echo "</h6>
      <br/>
      <h6><b>Company address : </b>".$business['address']."</h6>
      <br/>
      <h6><b>Address supplement : </b>".$business['address_supplement']."</h6>
      <br/>
      <h6><b>Postal code : </b>".$business['postal_code']."</h6>
      <br/>
      <h6><b>City : </b>".$business['city']."</h6>
      <br/>
      <h6><b>Company Description : </b></h6>
      <p>".$business['description']."</p>
    </div>
    </div>";

  }
    
}

echo "<a class='btn btn-floating btn-large waves-effect waves-light red'><i data-target='modal_new' class='material-icons modal-trigger'>add</i></a>";

echo "<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>New business</h4>
    <div class='row'>
        <div class='input-field col s12'>
          <input name='company_name' id='company_name' type='text' class='validate'>
          <label for='company_name'>Company name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='trade_name' id='trade_name' type='text' class='validate'>
          <label for='trade_name'>Trade name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='SIRET' id='SIRET' type='text' class='validate'>
          <label for='SIRET'>SIRET number</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='vat_number' id='vat_number' type='text' class='validate'>
          <label for='vat_number'>VAT number</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
        <select name='country'>
          <option value='germany' selected>Germany</option>
          <option value='belgium'>Belgium</option>
          <option value='canada'>Canada</option>
          <option value='espagne'>Spain</option>
          <option value='united_states'>United States</option>
          <option value='france'>France</option>
          <option value='italy'>Italy</option>
          <option value='luxembourg'>Luxembourg</option>
          <option value='malta'>Malta</option>
          <option value='netherlands'>Netherlands</option>
          <option value='portugal'>Portugal</option>
          <option value='united_kingdom'>United Kingdom</option>
        </select>
        <label>Pays</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address' id='address' type='text' class='validate'>
          <label for='address'>Company address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address_supplement' id='address_supplement' type='text' class='validate' value='(aucun)'>
          <label for='address_supplement'>Address supplement</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='postal_code' id='postal_code' type='text' class='validate'>
          <label for='postal_code'>Postal code</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='city' id='city' type='text' class='validate'>
          <label for='city'>City</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <textarea name='description' id='description' class='materialize-textarea'></textarea>
          <label for='description'>Company Description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit' type='submit' name='submit' value='Add' class='validate'>
      </div>
    </form>
    </div>";