<?php
require("class/Client.php");
require("class/Business.php");

$Client = new Client();
$Business = new Business();

require("actions/client/add_client.php");
require("actions/client/edit_client.php");
require("actions/client/remove_client.php");

echo "<table>
    <thead><tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Country</th>
        <th>Added on :</th>
        <th>Action :</th>
    </tr></thead>
    <tbody>";

if($Client->getClient() != null){

  $i = 0;

    foreach($Client->getClient() as $client) {

      $i = $i + 1;
        
        echo "<tr>
        <td>".$client['name']."</td>
        <td>".$client['email']."</td>
        <td>".$client['phone']."</td>
        <td>";
        if($client['country'] === 'germany'){
          echo 'Germany';
        }elseif($client['country'] === 'belgium'){
          echo 'Belgium';
        }elseif($client['country'] === 'canada'){
          echo 'Canada';
        }elseif($client['country'] === 'espagne'){
          echo 'Spain';
        }elseif($client['country'] === 'united_states'){
          echo 'United States';
        }elseif($client['country'] === 'france'){
          echo 'France';
        }elseif($client['country'] === 'italy'){
          echo 'Italy';
        }elseif($client['country'] === 'luxembourg'){
          echo 'Luxembourg';
        }elseif($client['country'] === 'malta'){
          echo 'Malta';
        }elseif($client['country'] === 'netherlands'){
          echo 'Netherlands';
        }elseif($client['country'] === 'portugal'){
          echo 'Portugal';
        }elseif($client['country'] === 'united_kingdom'){
          echo 'United Kingdom';
        }
        echo "</td>
        <td>".$client['date']."</td>
        <td><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_delete_".$i."'>Delete</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_".$i."'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a></td>
        </tr>";

    }

}else{

    echo "<tr>
        <td>No clients at the moment.</td>
        </tr>";

}

echo "</tbody>
    </table>";

if($Client->getClient() != null){

  $i = 0;
    
  foreach($Client->getClient() as $client) {

    $i = $i + 1;

    echo "<div id='modal_delete_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
      <h4>Client deletion</h4>
      <p>Are you sure you want to delete the selected client ?</p>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit_delete' type='submit' name='submit_delete' value='Yes' class='validate'>
        <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
    </div>
    <input id='value' type='hidden' name='value' value=".$client['id'].">
    </form>
    </div>";

    echo "<div id='modal_edit_".$i."' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>Edit the client</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='name' id='name' type='text' value='".$client['name']."' class='validate'>
          <label for='name'>Client name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='email' id='email' type='text' value='".$client['email']."' class='validate'>
          <label for='email'>E-mail address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='phone' id='phone' type='tel' value='".$client['phone']."' class='validate'>
          <label for='phone'>Phone number</label>
        </div>
      </div>
      <input type='hidden' name='category' value=".$client['category'].">
      <input type='hidden' name='langue' value=".$client['langue'].">
      <input type='hidden' name='country' value=".$client['country'].">
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address' id='address' type='text' value='".$client['address']."' class='validate'>
          <label for='address'>Customer's address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address_supplement' id='address_supplement' type='text' value='".$client['address_supplement']."' class='validate'>
          <label for='address_supplement'>Address supplement</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='postal_code' id='postal_code' type='text' value='".$client['postal_code']."' class='validate'>
          <label for='postal_code'>Postal code</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='city' id='city' type='text' value='".$client['city']."' class='validate'>
          <label for='city'>City</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <textarea name='description' id='description' class='materialize-textarea'>".$client['description']."</textarea>
          <label for='description'>Client description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='Edit the client' class='validate'>
      </div>
    <input id='value' type='hidden' name='value' value=".$client['id'].">
    </form>
    </div>";

    echo "<div id='modal_description_".$i."' class='modal modal-fixed-footer'>
    <div class='modal-content'>
      <h4>Customer information</h4>
      <br/>
      <h6><b>Client name : </b>".$client['name']."</h6>
      <br/>
      <h6><b>E-mail address : </b>".$client['email']."</h6>
      <br/>
      <h6><b>Phone number : </b>".$client['phone']."</h6>
      <br/>
      <h6><b>Associated company : </b>".$client['category']."</h6>
      <br/>
      <h6>";
      if($client['langue'] === 'english'){
        echo '<p><b>Language : </b> English</p>';
      }elseif($client['langue'] === 'french'){
        echo '<p><b>Language : </b> France</p>';
      }
      echo "</h6>
      <br/>
      <h6>";
      if($client['country'] === 'germany'){
        echo '<p><b>Country : </b> Germany</p>';
      }elseif($client['country'] === 'belgium'){
        echo '<p><b>Country : </b> Belgium</p>';
      }elseif($client['country'] === 'canada'){
        echo '<p><b>Country : </b> Canada</p>';
      }elseif($client['country'] === 'espagne'){
        echo '<p><b>Country : </b> Spain</p>';
      }elseif($client['country'] === 'united_states'){
        echo '<p><b>Country : </b> United States</p>';
      }elseif($client['country'] === 'france'){
        echo '<p><b>Country : </b> France</p>';
      }elseif($client['country'] === 'italy'){
        echo '<p><b>Country : </b> Italy</p>';
      }elseif($client['country'] === 'luxembourg'){
        echo '<p><b>Country : </b> Luxembourg</p>';
      }elseif($client['country'] === 'malta'){
        echo '<p><b>Country : </b> Malta</p>';
      }elseif($client['country'] === 'netherlands'){
        echo '<p><b>Country : </b> Netherlands</p>';
      }elseif($client['country'] === 'portugal'){
        echo '<p><b>Country : </b> Portugal</p>';
      }elseif($client['country'] === 'united_kingdom'){
        echo '<p><b>Country : </b> United Kingdom</p>';
      }
      echo "</h6>
      <br/>
      <h6><b>Customer's address : </b>".$client['address']."</h6>
      <br/>
      <h6><b>Address supplement : </b>".$client['address_supplement']."</h6>
      <br/>
      <h6><b>Postal code : </b>".$client['postal_code']."</h6>
      <br/>
      <h6><b>City : </b>".$client['city']."</h6>
      <br/>
      <h6><b>Client description : </b></h6>
      <p>".$client['description']."</p>
    </div>
    </div>";

  }
    
}

echo "<a class='btn btn-floating btn-large waves-effect waves-light red'><i data-target='modal_new' class='material-icons modal-trigger'>add</i></a>";

echo "<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>New customer</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='name' id='name' type='text' class='validate'>
          <label for='name'>Client name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='email' id='email' type='text' class='validate'>
          <label for='email'>E-mail address</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='phone' id='phone' type='tel' class='validate'>
          <label for='phone'>Phone number</label>
        </div>
      </div>
      <div class='row'>
      <div class='input-field col s12'>
      <select name='category'>
          <option value='individual' selected>Individual (individual customer)</option>";
      if($Business->getBusiness() != null){
        foreach ($Business->getBusiness() as $business) {
          echo "<option value='".$business['company_name']."'>".$business['company_name']."</option>";
        }
      }
echo "</select>
        <label>Associated company</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
        <select name='langue'>
          <option value='english' selected>English</option>
          <option value='french'>French</option>
        </select>
        <label>Language</label>
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
        <label>Country</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='address' id='address' type='text' class='validate'>
          <label for='address'>Customer's address</label>
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
          <label for='description'>Client description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit' type='submit' name='submit' value='Create the client' class='validate'>
      </div>
    </form>
    </div>";