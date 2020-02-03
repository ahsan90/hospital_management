<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
//
//$doctors = $_SESSION['doctors'];
//unset($_SESSION['doctors']);
$appointment = $data;
if (isset($_SESSION['slot'] )){
    $slot = $_SESSION['slot'];
    unset($_SESSION['slot'] );
}else{
    $slots = "";
}
    echo " Appointment ID ".$appointment->id."<br>";
    echo " Appointment ID ".$appointment->time."<br>";
    echo " Appointment ID ".$appointment->date."<br>";
?>

<?php
$this->end();
?>
