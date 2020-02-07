<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
$specializations = $_SESSION['doctors_specialization'];
//dnd($_SESSION['doctors_specialization']);
//dnd($specializations);
unset($_SESSION['doctors_specialization']);
if (isset($_SESSION['datePicked'])){
    unset($_SESSION['datePicked']);
}

?>

<div class="mt-3">
    <?php if (isset($_SESSION['msg']) || $msg != "" || isset($_REQUEST['msg'])){
        if (isset($_SESSION['msg']))
        {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }elseif ($msg != null){
            echo "<div>".$msg."</div>";
        }
        elseif (isset($_REQUEST['msg'])){
            echo $_REQUEST['msg'];
            unset($_REQUEST['msg']);
        }
    }
    ?>
</div>

<form action="<?=SROOT?>appointment/booking" method="post" class="mt-5">
    <fieldset  class="scheduler-border">
        <legend  class="scheduler-border">Book an Appointment</legend>

        <div class="mt-4">
            <label for="gender">Select Doctor's Specialization</label>

            <select name="specialization">
                <?php
                if ($specializations != "" || $specializations |= null){
                    foreach ($specializations as $specialization){
                        echo "<option value='".$specialization."' >".$specialization."</option>";
                    }
                }else{
                    echo "<option value='0' >No data available</option>";
                }

                ?>
            </select>
            <label for="name" class="ml-3">Pick a date</label>
            <input type="date" value="<?php date('Y-m-d'); ?>" name="date"/>

            <?php if (LoginHelper::isACurrentNurse() || LoginHelper::isAdmin()) { ?>

            <div>
                <label for="dob">Health Card Number</label>
                <input type="text" class="form-control" id="dob" value='' placeholder="Patient's health card number" name="healthCardNo" required>
            </div>
            <?php } ?>
            <button type="submit" name="submit" class="btn btn-outline-primary">Search for an appointment</button>

        </div>
    </fieldset>
</form>

<?php
$this->end();
?>
