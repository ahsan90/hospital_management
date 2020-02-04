<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
//
//$doctors = $_SESSION['doctors'];
//unset($_SESSION['doctors']);
$appointment = $data;
if (isset($_SESSION['doctor'])){
    $doctor = $_SESSION['doctor'];
    unset($_SESSION['doctor']);
}
if (isset($_SESSION['slot'] )){
    $slot = $_SESSION['slot'];
    unset($_SESSION['slot'] );
}else{
    $slot = "";
}
?>
<div class="jumbotron">
    <h2>Appointment details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Appointment date</th>

                <th>Appointment time</th>

                <th>Doctor Name</th>

                <th>Specialization</th>
            </tr>
        </thead>
        <tbody>

    <?php
    echo "<tr><td>".$appointment->date."</td>";
    echo "<td>".Schedule::all()->find($slot)->time."</td>";
    echo "<td>".$doctor->name."</td>";
    echo "<td>".$doctor->specialization."</td></tr>";

    ?></tbody>
    </table>
</div>

<?php
$this->end();
?>
