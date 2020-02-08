<?php
$this->setSiteTitle('Doctor Profile');

$this->start('body');
?>
    <div class="mt-3">
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

//echo "<p>".$doctor->id."</p>";
?>

<?php
$this->end();
?>