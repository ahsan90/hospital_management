<?php
//$doctors = $data;
//require_once './app/views/layout/header.php';
$this->setSiteTitle('Patient listing');

$this->start('body');
if ($data != null){
    ?>

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
        foreach ($data as $patient) {
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
            echo "<td><a href='./edit/" . $patient->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
            echo "<td><a href='./profile/" . $patient->id. "' title='Go to Profile' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-user'></i></a></td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>

    <?php
}else{
    echo "<h2>No record found...!</h2>";
}
$this->end();
?>