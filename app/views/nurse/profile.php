<?php
$this->setSiteTitle('Nurse Profile');

$this->start('body');
?>

<table class="table table-hover">
    <thead>
    <tr>
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
        $nurse = $data;
        echo "<tr>";
        echo "<td>$nurse->name</td>";
        echo "<td>$nurse->gender</td>";
        echo "<td>$nurse->phone</td>";
        echo "<td>$nurse->email</td>";
        echo "<td>$nurse->address</td>";
        echo "<td>$nurse->created_at</td>";
        echo "<td>$nurse->updated_at</td>";
        echo "<td>".Role::all()->where('id', $nurse->role_id)->first()->roleType."</td>";
        echo "<td><a href='".SROOT."nurse/edit/" . $nurse->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
        echo "</tr>";

    ?>

    </tbody>
</table>
<?php
$this->end();
?>