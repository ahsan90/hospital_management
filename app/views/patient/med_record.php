<?php
$this->setSiteTitle('Patient Profile');

$this->start('body');
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
<?php if (LoginHelper::isACurrentDoctor()) { ?>
    <a href="<?=SROOT?>doctor/profile/<?=UserHelper::getCurrentLoggedInDoctor()->id?>" class="btn btn-primary"><<&nbsp;Go to profile</a>
<?php } ?>


<?php if (LoginHelper::isACurrentNurse()) { ?>
    <a href="<?=SROOT?>nurse/profile/<?=UserHelper::getCurrentLoggedInNurse()->id?>" class="btn btn-primary"><<&nbsp;Go to profile</a>
<?php } ?>


<?php
$medical_records = MedicalRecord::all()->where('patient_id', $data)->first();

//$count = UserHelper::countObj($medical_records);
//dnd($count);


if ($medical_records){
    ?>
    <div class="jumbotron mx-auto">
        <h2>Patient's medical record</h2>
        <table class="table table-striped">
                <tr>
                    <th>Blood Pressure</th>
                    <td><?=$medical_records->blood_pressure?></td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td><?=$medical_records->weight?></td>
                </tr>
                <tr>
                    <th>Height</th>
                    <td><?=$medical_records->height?></td>
                </tr>
                <tr>
                    <th>Pulse rate</th>
                    <td><?=$medical_records->pulseRate?></td>
                </tr>

                <tr>
                    <th>Nurse note</th>
                    <td><?=$medical_records->nurseNotes?></td>
                </tr>
                <tr>
                    <th>Diagnose</th>
                    <td><?=$medical_records->diagnose?></td>
                </tr>
        </table>
        <a href="<?=SROOT?>patient/edit_med_record/<?=$medical_records->id?>" class="btn btn-warning">Edit medical record</a>
    </div>

    <?php
}else{
    echo "<p class='alert alert-warning mx-auto'>No medical record found this patient..</p>";
    echo "<td><a href='".SROOT."patient/create_med_record/" . $data. "' title='Create medical record' class='btn btn-primary btn-xs' data-toggle='tooltip'><i class='fa fa-plus'></i>&nbsp;Create record</a></td>";
}
?>

<?php
$this->end();
?>