<?php
require("class/Service.php");

$Service = new Service();

require("actions/service/add_service.php");
require("actions/service/edit_service.php");
require("actions/service/delete_service.php");

echo "<table>
    <thead><tr>
        <th>Name</th>
        <th>Category</th>
        <th>Cost per hour in € :</th>
        <th>Created on :</th>
        <th>Action :</th>
    </tr></thead>
    <tbody>";

if($Service->getService() != null){

  $i = 0;

    foreach ($Service->getService() as $service) {

      $i = $i + 1;
        
      echo "<tr>
      <td>".$service['name']."</td>
      <td>".$service['category']."</td>
      <td>".$service['costhour']."€</td>
      <td>".$service['date']."</td>
      <td><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_delete_".$i."'>Delete</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_".$i."'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a></td>
      </tr>";

    }

}else{

    echo "<tr>
    <td>No service at the moment.</td>
    </tr>";

}

echo "</tbody>
    </table>";

if($Service->getService() != null){

  $i = 0;

    foreach ($Service->getService() as $service) {

      $i = $i + 1;

      echo "<div id='modal_delete_".$i."' class='modal modal-fixed-footer'>
      <form class='col s6' method='post'>
      <div class='modal-content'>
        <h4>Service termination</h4>
        <p>Are you sure you want to delete the selected service ?</p>
      </div>
      <div class='modal-footer'>
          <input class='waves-effect waves-green btn' id='submit_delete' type='submit' name='submit_delete' value='Yes' class='validate'>
          <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
      </div>
      <input id='value' type='hidden' name='value' value=".$service['id'].">
      </form>
      </div>";

      echo "<div id='modal_edit_".$i."' class='modal modal-fixed-footer'>
      <form class='col s6' method='post'>
      <div class='modal-content'>
      <h4>Modify the service</h4>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='name' id='name' type='text' value='".$service['name']."' class='validate'>
            <label for='name'>Service name</label>
          </div>
        </div>
        <input name='category' id='category' type='hidden' value='".$service['category']."' class='validate'>
        <div class='row'>
          <div class='input-field col s12'>
            <input name='costhour' id='costhour' type='number' value='".$service['costhour']."' class='validate'>
            <label for='costhour'>Cost per hour in €</label>
          </div>
        </div>
        <div class='row'>
          <div class='input-field col s12'>
            <textarea name='description' id='description' class='materialize-textarea'>".$service['description']."</textarea>
            <label for='description'>Service description</label>
          </div>
        </div>
      </div>
      <div class='modal-footer'>
            <input class='modal-close waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='Modify the service' class='validate'>
          </div>
      <input id='value' type='hidden' name='value' value=".$service['id'].">
      </form>
      </div>";

      echo "<div id='modal_description_".$i."' class='modal modal-fixed-footer'>
          <div class='modal-content'>
            <h4>Service information</h4>
            <br/>
            <h6><b>Service name : </b>".$service['name']."</h6>
            <br/>
            <h6><b>Category name : </b>".$service['category']."</h6>
            <br/>
            <h6><b>Cost per hour in € : </b>".$service['costhour']."€</h6>
            <br/>
            <h6><b>Description :</b></h6>
            <p>".$service['description']."</p>
          </div>
        </div>";

    }

}

echo "<a class='btn btn-floating btn-large waves-effect waves-light red'><i data-target='modal_new' class='material-icons modal-trigger'>add</i></a>";

echo "<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>New service</h4>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='name' id='name' type='text' class='validate'>
          <label for='name'>Service name</label>
        </div>
      </div>
      <div class='row'>
      <div class='input-field col s12'>
      <select name='category'>
        <option value='BIC-1'>Merchandise buying and selling activity (BIC)</option>
        <option value='BIC-2'>Commercial and artisanal services (BIC)</option>
        <option value='BNC'>Service provision and liberal professions (BNC)</option>
      </select>
      <label>Category name</label>
    </div>
    </div>
      <div class='row'>
        <div class='input-field col s12'>
          <input name='costhour' id='costhour' type='number' class='validate'>
          <label for='costhour'>Cost per hour in €</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s12'>
          <textarea name='description' id='description' class='materialize-textarea'></textarea>
          <label for='description'>Service description</label>
        </div>
      </div>
    </div>
    <div class='modal-footer'>
          <input class='modal-close waves-effect waves-green btn' id='submit' type='submit' name='submit' value='Create the service' class='validate'>
        </div>
    </form>
    </div>";