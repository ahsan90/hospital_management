<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
$doctors = $_SESSION['doctors'];
unset($_SESSION['doctors']);
?>

<form action="<?=SROOT?>appointment/booking" method="post" class="mt-5">
    <fieldset  class="scheduler-border">
        <legend  class="scheduler-border">Book an Appointment</legend>

        <div class="mt-4">
            <label for="gender">Select Doctor's Specialization</label>

            <select name="specialization">
                <?php
                if ($doctors != ""){
                    foreach ($doctors as $doctor){
                        echo "<option value='".$doctor->specialization."' >".$doctor->specialization."</option>";
                    }
                }else{
                    echo "<option value='0' >No data available</option>";
                }

                ?>
            </select>
            <label for="name" class="ml-3">Pick a date</label>
            <input type="date" value="<?php date('Y-m-d'); ?>" name="date"/>

            <button type="submit" name="submit" class="btn btn-outline-primary">Search for an appointment</button>

        </div>
    </fieldset>
</form>

<?php
$this->end();
?>
