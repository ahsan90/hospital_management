<?php
$this->setSiteTitle('Nurse listing');

$this->start('body');
if ($data != null){
    ?>

    <a href="<?=SROOT.'nurse/create'?>" class="btn btn-outline-primary"><i class='fa fa-plus'>Add a new nurse account</i></a>
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
        foreach ($data as $nurse) {
            echo "<tr>";
            echo "<td>$nurse->name</td>";
            echo "<td>$nurse->gender</td>";
            echo "<td>$nurse->phone</td>";
            echo "<td>$nurse->email</td>";
            echo "<td>$nurse->address</td>";
            echo "<td>$nurse->created_at</td>";
            echo "<td>$nurse->updated_at</td>";
            echo "<td>".Role::all()->where('id', $nurse->role_id)->first()->roleType."</td>";
            echo "<td><a href='./edit/" . $nurse->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
            echo "<td><a href='./profile/" . $nurse->id. "' title='Go to Profile' class='btn btn-info btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-user'></i></a></td>";
            echo "<td><a href='./delete/" . $nurse->id. "' title='Go to Profile' class='btn btn-danger btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-trash'></i></a></td>";
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