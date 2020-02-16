<?php
$this->setSiteTitle('Nurse Profile');

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
<?php $nurse = $data;
if ($nurse != null) { ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Created at</th>
            <th>Last updated</th>
            <th>Role Type</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $user_id = Nurse::all()->find($nurse->id)->user_id;

        //Delete both associated login account and doctor's account
        $user = User::all()->find($user_id);

        echo "<tr>";
        echo "<td>$user->username</td>";
        echo "<td>$nurse->name</td>";
        echo "<td>$nurse->gender</td>";
        echo "<td>$nurse->phone</td>";
        echo "<td>$nurse->email</td>";
        echo "<td>$nurse->address</td>";
        echo "<td>$nurse->created_at</td>";
        echo "<td>$nurse->updated_at</td>";
        echo "<td>" . Role::all()->where('id', $nurse->role_id)->first()->roleType . "</td>";
        echo "<td><a href='" . SROOT . "nurse/edit/" . $nurse->id . "' title='Edit Record' class='btn btn-warning btn-xs' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
//        echo "<td><a href='" . SROOT . "nurse/profile/" . $nurse->id . "' title='Go to Profile' class='btn btn-info btn-xs' data-toggle='tooltip'><i class='fa fa-user'></i></a></td>";
//        echo "<td><a href='" . SROOT . "nurse/delete/" . $nurse->id . "' title='Delete record' class='btn btn-danger btn-xs' data-toggle='tooltip'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";

        ?>

        </tbody>
    </table>
    <?php
} else {
    echo "<div><p class='alert alert-info'>No data available</p></div>";
}

?>

<?php
$appointments = Appointment::all()->sortBy('date');

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
                <th>Doctor Name</th>

                <th>Patient Name</th>

                <!--                <th>Cancel Appointment</th>-->
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($appointments as $appointment){
                echo "<tr><td>".$appointment->date."</td>";
                echo "<td>".$appointment->time."</td>";
                echo "<td>".Doctor::all()->where('id', $appointment->doctor_id)->first()->name."</td>";
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
    echo "<p class='alert alert-warning mx-auto'>No appointments yet..</p>";
}
?>

<?php
$this->end();
?>