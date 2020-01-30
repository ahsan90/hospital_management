<?php
$this->setSiteTitle('Patient Profile');

$this->start('body');
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
<?php
$this->end();
?>