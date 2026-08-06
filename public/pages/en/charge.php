<?php
require("class/Charge.php");
require("class/Bank.php");

$Charge = new Charge();
$Bank = new Bank();

require("actions/charge/add_charge.php");
require("actions/charge/cancel_charge.php");
require("actions/charge/edit_charge.php");
require("actions/charge/validate_charge.php");

echo "<table>
    <thead><tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price in €</th>
        <th>Created on :</th>
        <th>Action :</th>
    </tr></thead>
    <tbody>";

if($Charge->getCharge() != null){

    $i = 0;
        
    foreach($Charge->getCharge() as $charge) {
    
        $i = $i + 1;

        echo "<tr>
        <td>".$charge['name']."</td>
        <td>";
        if($charge['category'] === 'invoice'){
            echo "Invoice";
        }elseif($charge['category'] === 'taxation'){
            echo "Taxation";
        }elseif($charge['category'] === 'paybic1'){
            echo "Final withholding payment BIC-1";
        }elseif($charge['category'] === 'paybic2'){
            echo "Final withholding payment BIC-2";
        }elseif($charge['category'] === 'paybnc'){
            echo "Final withholding payment BNC";
        }elseif($charge['category'] === 'training'){
            echo "Training for self-employed professionals";
        }
        echo "</td>
        <td>".$charge['price']."€</td>
        <td>".$charge['date']."</td>";
        if($charge['state'] === 'active'){
            echo "<td><a class='waves-effect waves-light btn red modal-trigger' data-target='modal_cancel_".$i."'>Cancel the charge</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_edit_".$i."'>To modify</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a><a class='waves-effect waves-light btn modal-trigger' data-target='modal_validate_".$i."'>Validate the load</a></td>";
        }else{
            echo "<td><a class='waves-effect waves-light btn modal-trigger' data-target='modal_description_".$i."'>Information</a></td>";
        }
        echo "</tr>";
    
    }
        
}else{

    echo "<tr>
        <td>No charge for the moment.</td>
        </tr>";

}

echo "</tbody>
    </table>";

if($Charge->getCharge() != null){

    $i = 0;
        
    foreach($Charge->getCharge() as $charge) {
    
        $i = $i + 1;
    
        echo "<div id='modal_cancel_".$i."' class='modal modal-fixed-footer'>
        <form class='col s6' method='post'>
        <div class='modal-content'>
        <h4>Cancel the charge</h4>
        <p>Are you sure you want to cancel the selected charge ?</p>
        </div>
        <div class='modal-footer'>
            <input class='waves-effect waves-green btn' id='submit_cancel' type='submit' name='submit_cancel' value='Yes' class='validate'>
            <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
        </div>
        <input id='value' type='hidden' name='value' value=".$charge['id'].">
        </form>
        </div>";
    
        echo "<div id='modal_edit_".$i."' class='modal modal-fixed-footer'>
        <form class='col s6' method='post'>
        <div class='modal-content'>
        <h4>Modify the load</h4>
        <div class='row'>
            <div class='input-field col s12'>
            <input name='name' id='name' type='text' value='".$charge['name']."' class='validate'>
            <label for='name'>Name of the charge</label>
            </div>
        </div>
        <input type='hidden' name='category' value=".$charge['category'].">
        <div class='row'>
          <div class='input-field col s12'>
            <input name='price' id='price' type='number' value='".$charge['price']."' class='validate'>
            <label for='price'>Price</label>
          </div>
        </div>
        <div class='row'>
            <div class='input-field col s12'>
            <textarea name='description' id='description' class='materialize-textarea'>".$charge['description']."</textarea>
            <label for='description'>Description of the load</label>
            </div>
        </div>
        </div>AND state=:state
        <div class='modal-footer'>
            <input class='waves-effect waves-green btn' id='submit_edit' type='submit' name='submit_edit' value='Modify the load' class='validate'>
        </div>
        <input id='value' type='hidden' name='value' value=".$charge['id'].">
        </form>
        </div>";

        echo "<div id='modal_description_".$i."' class='modal modal-fixed-footer'>
        <div class='modal-content'>
            <h4>Load information</h4>
            <br/>
            <h6><b>Load name : </b>".$charge['name']."</h6>
            <br/>
            <h6><b>Category : </b>";
            if($charge['category'] === 'invoice'){
                echo "Invoice";
            }elseif($charge['category'] === 'taxation'){
                echo "Taxation";
            }elseif($charge['category'] === 'paybic1'){
                echo "Final withholding payment BIC-1";
            }elseif($charge['category'] === 'paybic2'){
                echo "Final withholding payment BIC-2";
            }elseif($charge['category'] === 'paybnc'){
                echo "Final withholding payment BNC";
            }elseif($charge['category'] === 'training'){
            echo "Training for self-employed professionals";
            }
            echo "</h6>
            <br/>
            <h6><b>Price in € : </b>".$charge['price']."€</h6>
            <br/>
            <h6><b>Status : </b>";
            if($charge['state'] === 'active'){
            echo "Invalid";
            }elseif($charge['state'] === 'validated'){
            echo "Valid";
            }elseif($charge['state'] === 'cancel'){
            echo "Canceled";
            }
            echo "</h6>
            <br/>
            <h6><b>Description :</b></h6>
            <p>".$charge['description']."</p>
        </div>
        </div>";

        echo "<div id='modal_validate_".$i."' class='modal modal-fixed-footer'>
            <form class='col s6' method='post'>
            <div class='modal-content'>
            <h4>Validation of the selected load</h4>
            <p>Are you sure you want to confirm the selected load ?</p>
            </div>
            <div class='modal-footer'>
                <input class='waves-effect waves-green btn' id='submit_validate' type='submit' name='submit_validate' value='Yes' class='validate'>
                <input class='modal-close waves-effect waves-green btn red' id='cancel' type='submit' name='cancel' value='No' class='validate'>
            </div>
            <input id='value' type='hidden' name='value' value=".$charge['id'].">
            </form>
            </div>";
    
    }
        
}
    
echo "<a class='btn btn-floating btn-large waves-effect waves-light red'><i data-target='modal_new' class='material-icons modal-trigger'>add</i></a>";
    
echo "<div id='modal_new' class='modal modal-fixed-footer'>
    <form class='col s6' method='post'>
    <div class='modal-content'>
    <h4>New charge</h4>
    <div class='row'>
        <div class='input-field col s12'>
        <input name='name' id='name' type='text' class='validate'>
        <label for='name'>Name of the charge</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12'>
        <select name='category'>
          <option value='training' selected>Training for self-employed professionals</option>
          <option value='paybic1'>Final withholding payment BIC-1</option>
          <option value='paybic2'>Final withholding payment BIC-2</option>
          <option value='paybnc'>Final withholding payment BNC</option>
          <option value='taxation'>Taxation</option>
          <option value='invoice'>Invoice</option>
        </select>
        <label>Category</label>
        </div>
      </div>
    <div class='row'>
        <div class='input-field col s12'>
        <input name='price' id='price' type='number' class='validate'>
        <label for='price'>Price</label>
        </div>
    </div>
    <div class='row'>
            <div class='input-field col s12'>
            <textarea name='description' id='description' class='materialize-textarea'></textarea>
            <label for='description'>Description of the load</label>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <input class='waves-effect waves-green btn' id='submit' type='submit' name='submit' value='Perform the charging operation' class='validate'>
    </div>
    </form>
    </div>";