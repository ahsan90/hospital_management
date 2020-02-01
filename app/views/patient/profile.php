<?php
$this->setSiteTitle('Patient Profile');

$this->start('body');
?>
<div class="container">

    <div>
        <?php if (isset($_SESSION['msg']) || $msg != null)
        {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }elseif ($msg != null){
            echo $msg;
        }
        ?>
    </div>
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

            echo "<td><a href='".SROOT."patient/edit/" . $patient->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
            echo "</tr>";

        ?>

        </tbody>
    </table>

</div>
<?php
$this->end();
?>