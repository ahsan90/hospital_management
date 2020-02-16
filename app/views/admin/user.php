<?php
//$doctors = $data;
//require_once './app/views/layout/header.php';
$this->setSiteTitle('Users List');

$this->start('body');

if ($data != null){
    ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Role type</th>
            <th>Create at</th>
            <th>Last updated</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $user) {

            echo "<tr>";
            echo "<td>$user->username</td>";
            //echo "<td>$user->role->id</td>";
            echo "<td>".Role::all()->where('id', $user->role_id)->first()->roleType."</td>";
            echo "<td>$user->created_at</td>";
            echo "<td>$user->updated_at</td>";
            echo "<td><a href='./edit/" . $user->id. "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a></td>";
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