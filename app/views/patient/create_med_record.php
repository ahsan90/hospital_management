<?php
$this->setSiteTitle('New Patient');

$this->start('body');

//$newPatient = $data;

?>


<form action="<?=SROOT?>patient/create_med_record_post/<?=$data?>" method="post" class="mt-5">
    <fieldset  class="scheduler-border">
        <legend  class="scheduler-border">Add Medical Record</legend>

        <div class="form-group">
            <label for="name">Blood Pressure</label>
            <input type="text" class="form-control" id="name" value='' placeholder="Blood Pressure" name="blood_pressure" required>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" class="form-control" value='' placeholder="Weight" name="weight" required>
        </div>


        <div class="form-group">
            <label for="height">Height</label>
            <input type="text" class="form-control" value='' placeholder="Height" name="height" required>
        </div>
        <div class="form-group">
            <label for="author">Pulse Rate</label>
            <input type="text" class="form-control" value='' placeholder="Pulse Rate" name="pulseRate" required>
        </div>
        <?php if (LoginHelper::isACurrentNurse()) {?>
        <div class="form-group">
            <label for="dob">Nurse note</label>
            <textarea  class="form-control" placeholder="Nurse note" name="nurseNotes" required></textarea>
        </div>
        <?php }?>
        <?php if (LoginHelper::isACurrentDoctor()) {?>
        <div class="form-group">
            <label for="phone">Diagnose</label>
            <textarea  class="form-control" placeholder="Diagnose" name="diagnose" required></textarea>
        </div>
        <?php }?>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Add Medical record</button>
        </div>
    </fieldset>
</form>

<?php
$this->end();
?>