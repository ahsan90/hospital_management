<?php
$this->setSiteTitle('New Patient');

$this->start('body');

$aPatient = $data;

?>


    <div class="mt-3">
        <?php if (isset($_SESSION['msg']) || $msg != null)
        {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }elseif ($msg != null){
            echo $msg;
        }
        ?>
    </div>
    <form action="<?=SROOT?>patient/update/<?=$aPatient->id?>" method="post">
        <fieldset  class="scheduler-border">
            <legend  class="scheduler-border">Update Patient</legend>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="<?=$aPatient->name?>" placeholder="Your name" name="name" required>
            </div>
            <div class="form-group">
                <label for="author">Health Card Number</label>
                <input type="text" class="form-control" id="author" value="<?=$aPatient->healthCardNumber?>" placeholder="Health Card No" name='healthCardNumber' required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" value="<?= $aPatient->dob ?>" placeholder="Date of birth" name='dob' required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>

                <select class="form-control" name="gender">
                    <option value="Male" selected="Male">Male</option>
                    <option value="Male">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" value="<?=$aPatient->phone?>" placeholder="Phone number" name='phone' required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="<?=$aPatient->email?>" placeholder="Email" name='email' required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" value="<?=$aPatient->address?>" placeholder="Address" name='address' required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </fieldset>
    </form>

<?php
$this->end();
?>

