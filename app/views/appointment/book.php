<?php
$this->setSiteTitle('Book an appointment');

$this->start('body');
$doctors = $_SESSION['doctors'];
unset($_SESSION['doctors']);

if (isset($_SESSION['datePicked'])){
    $datePicked = $_SESSION['datePicked'];
    unset($_SESSION['datePicked']);
}

if (isset($_SESSION['slots'] )){
    //$datePicked = $_SESSION['datePicked'];
    $slots = $_SESSION['slots'];
    unset($_SESSION['slots'] );
    //unset($_SESSION['datePicked']);
}else{
    $slots = "";
}

//echo $datePicked;

?>


<form action="<?=SROOT?>appointment/bookingPost" method="post" id="booking-form" class="mt-5">
    <fieldset  class="scheduler-border">
        <legend  class="scheduler-border">Book an Appointment</legend>

        <div class="form-group">
            <input type="hidden" name="datePicked" value="<?=$datePicked?>" id="datepicked">
            <label for="Doctor">Select from available doctors</label>


            <select class="form-control" name="doctorId" id="doctor_idChange">
                <option value="0" disabled selected>Please choose one</option>
                <?php
                if ($doctors != ""){
                    foreach ($doctors as $doctor){
                        echo "<option value='".$doctor->id."' >".$doctor->name."</option>";
                    }
                }else{
                    echo "<option value=0 >No doctor available</option>";
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Select from available time slot</label>
            <select class="form-control" name="slot" id="selectSlot" required>

            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block book-btn" id="bookBtn" disabled>Book Appointment</button>
        </div>
    </fieldset>
</form>
<?php //dnd($datePicked)?>
<script>
    //Make an ajax call for pulling the the time slot upon selecting a doctor from drop down
    $('#doctor_idChange').change(function(){
        //alert($(this).val());
        let doctor_id = $(this).val();
        let datePicked = $('#datepicked').val();
        $.ajax({
            type: "POST",
            url: '<?=SROOT?>appointment/bookingAjax',
            data: {datePicked, doctor_id},
            success: function (response) {
                if (response.success){
                    const slot = $('#selectSlot');

                    $(slot).find('option').remove().end().append('<option value="0" disabled selected>Select Time</option>').val('0');
                    for(let i = 0; i<response.data.selectedSchedules.length; i++){
                        const op = $('<option/>', {value: response.data.selectedSchedules[i]})
                            .text(response.data.selectedSchedules[i]);
                        op.appendTo(slot);
                    }

                    //console.log(response.data.selectedSchedules);
                    //console.log(response.data.datep);
                    //console.log(response.data.doctor_id);
                    //console.log(response.data.checkSchedule);

                    $(slot).change( function () {
                        let selectedSlot = $(this).children("option:selected").val();
                            if(selectedSlot !== "0"){
                                $('#bookBtn').prop("disabled", false);
                            }
                        }
                    )
                    //console.log($(slot).val())
                }
            }
        });
        //Make the button disabled again if change happens in doctor selection
        $('#bookBtn').prop("disabled", true);
    })
</script>

<?php
$this->end();
?>
