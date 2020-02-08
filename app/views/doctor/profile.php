<?php
$this->setSiteTitle('Doctor Profile');

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
    <h2 class="mt-5">Your profile information</h2>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Specialization</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <?php if (LoginHelper::isAdmin() || LoginHelper::isACurrentDoctor()) {?>
        <th>Role Type</th>

        <th>Actions</th>
        <?php }?>
    </tr>
    </thead>
    <tbody>
    <?php
        $doctor = $data;
        echo "<tr>";
        echo "<td>$doctor->name</td>";
        echo "<td>$doctor->specialization</td>";
        echo "<td>$doctor->gender</td>";
        echo "<td>$doctor->phone</td>";
        echo "<td>$doctor->email</td>";
        echo "<td>$doctor->address</td>";

        if (LoginHelper::isAdmin() || LoginHelper::isACurrentDoctor()){
        echo "<td>".Role::all()->where('id', $doctor->role_id)->first()->roleType."</td>";

            echo "<td><a href='".SROOT."doctor/edit/" . $doctor->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
        }
        echo "</tr>";

    ?>

    </tbody>
</table>

<?php
//Make sure current loggedIn patient is not allowed to see the appointment list booked by other patients
if (!LoginHelper::isACurrentPatient()){
$appointments = Appointment::all()->where('doctor_id', $doctor->id);

$count = UserHelper::countObj($appointments);
//dnd($count);
if ($count>0){
    ?>
    <div class="jumbotron mx-auto">
        <h2 class="mb-2">Patients' appointment listing</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Appointment date</th>

                <th>Appointment time</th>

                <th>Patient Name</th>

<!--                <th>Cancel Appointment</th>-->
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($appointments as $appointment){
                echo "<tr><td>".$appointment->date."</td>";
                echo "<td>".$appointment->time."</td>";
                //echo "<td>".Doctor::all()->where('id', $appointment->doctor_id)->first()->name."</td>";
                echo "<td><a href='".SROOT."patient/medicalRecord/" . $appointment->patient_id. "' title='See medical information details' class='btn btn-warning btn-xs' data-toggle='tooltip'><i class='fa fa-user'></i></a>
                            ".Patient::all()->where('id', $appointment->patient_id)->first()->name."</td>";
                //echo "<td>".Doctor::all()->where('id', $appointment->doctor_id)->first()->specialization."</td>";
                //echo "<td><a href='".SROOT."appointment/delete/" . $appointment->id. "' title='Delete appointment' class='btn btn-danger btn-xs mx-auto' data-toggle='tooltip'><i class='fa fa-trash'></i></a></td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php
}else{
    echo "<p class='alert alert-warning mx-auto'>You do not have any appointments yet..</p>";
}
}
?>

<?php
$this->end();
?>