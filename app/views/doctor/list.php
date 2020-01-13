<?php
//$doctors = $data;

//require_once './app/views/layout/header.php';
if ($data != null){
    ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Specialization</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $doctor) {
            echo "<tr>";
                echo "<td>$doctor->name</td>";
                echo "<td>$doctor->specialization</td>";
                echo "<td>$doctor->phone</td>";
                echo "<td>$doctor->email</td>";
                echo "<td>$doctor->address</td>";
                echo "<td><a href='./edit/" . $doctor->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>

    <?php
}else{
    echo "<h2>No record found...!</h2>";
}
 //require_once './app/views/layout/footer.php';

?>
