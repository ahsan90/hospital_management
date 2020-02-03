<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
$doctors = $_SESSION['doctors'];
unset($_SESSION['doctors']);

if (isset($_SESSION['datePicked'])){
    $datePicked = $_SESSION['datePicked'];
    unset($_SESSION['datePicked']);
}

if (isset($_SESSION['slots'] )){
    //$datePicked = $_SESSION['datePicked'];
    $slots = $_SESSION['slots'];
    unset($_SESSION['slots'] );
    //unset($_SESSION['datePicked']);
}else{
    $slots = "";
}

echo $datePicked;

?>


<form action="<?=SROOT?>appointment/bookingPost" method="post" id="booking-form" class="mt-5">
    <fieldset  class="scheduler-border">
        <legend  class="scheduler-border">Book an Appointment</legend>

        <div class="form-group">
            <input type="hidden" name="datePicked" value="<?=$datePicked?>">
            <label for="gender">Select from available time slot</label>


            <select class="form-control" name="doctorId">
                <?php
                if ($doctors != ""){
                    foreach ($doctors as $doctor){
                        echo "<option value='".$doctor->id."' >".$doctor->name."</option>";
                    }
                }else{
                    echo "<option value='0' >No data available</option>";
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="slot">
                <?php
                if ($slots != ""){
                    foreach ($slots as $slot){
                        echo "<option value='".$slot->time."' >".$slot->time."</option>";
                    }
                }else{
                    echo "<option value='0' >No data available</option>";
                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Book</button>
        </div>
    </fieldset>
</form>

<?php
$this->end();
?>
