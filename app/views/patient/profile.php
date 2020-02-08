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
    <h2 class="mt-5">Your profile information</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Health Card No</th>
            <th>Date of Birth</th>
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
            if (isset($_SESSION['patient']) || $data != null){
                if (isset($_SESSION['patient'])){
                    $patient = $_SESSION['patient'];
                    unset($_SESSION['patient']);
                }
                elseif ($data != null){
                    $patient = $data;
                }
            }
            $patient = $data;
            echo "<tr>";
            echo "<td>$patient->name</td>";
            echo "<td>$patient->healthCardNumber</td>";
            echo "<td>$patient->dob</td>";
            echo "<td>$patient->gender</td>";
            echo "<td>$patient->phone</td>";
            echo "<td>$patient->email</td>";
            echo "<td>$patient->address</td>";
            echo "<td>$patient->created_at</td>";
            echo "<td>$patient->updated_at</td>";
            echo "<td>".Role::all()->where('id', $patient->role_id)->first()->roleType."</td>";

            echo "<td><a href='".SROOT."patient/edit/" . $patient->id. "' title='Edit Record' class='btn btn-warning btn-xs' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
            //echo "<td><a href='".SROOT."patient/profile/" . $patient->id. "' title='Go to Profile' class='btn btn-info btn-xs' data-toggle='tooltip'><i class='fa fa-user'></i></a></td>";
            if (LoginHelper::isAdmin()){
                echo "<td><a href='".SROOT."patient/delete/" . $patient->id. "' title='Delete record' class='btn btn-danger btn-xs' data-toggle='tooltip'><i class='fa fa-trash'></i></a></td>";
            }

            echo "</tr>";

        ?>

        </tbody>
    </table>
<?php
    $appointments = Appointment::all()->where('patient_id', $patient->id);

    $count = UserHelper::countObj($appointments);
    //dnd($count);
    if ($count>0){
        ?>
        <div class="jumbotron mx-auto">
            <h2>Appointment listing</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Appointment date</th>

                    <th>Appointment time</th>

                    <th>Doctor Name</th>

                    <th>Specialization</th>
                    <th>Cancel Appointment</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($appointments as $appointment){
                    echo "<tr><td>".$appointment->date."</td>";
                    echo "<td>".$appointment->time."</td>";
                    //echo "<td>".Doctor::all()->where('id', $appointment->doctor_id)->first()->name."</td>";
                    echo "<td><a href='".SROOT."doctor/profile/" . $appointment->doctor_id. "' title='Doctor details' class='btn btn-warning btn-xs' data-toggle='tooltip'><i class='fa fa-user'></i></a>
                            ".Doctor::all()->where('id', $appointment->doctor_id)->first()->name."</td>";
                    echo "<td>".Doctor::all()->where('id', $appointment->doctor_id)->first()->specialization."</td>";
                    echo "<td><a href='".SROOT."appointment/delete/" . $appointment->id. "' title='Delete appointment' class='btn btn-danger btn-xs mx-auto' data-toggle='tooltip'><i class='fa fa-trash'></i></a>
                            </td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php
    }else{
        echo "<p class='alert alert-warning mx-auto'>You do not have any appointments yet..</p>";
    }
?>

<?php
$this->end();
?>