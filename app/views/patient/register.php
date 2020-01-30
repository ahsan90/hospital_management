<?php
$this->setSiteTitle('New Patient');

$this->start('body');

$newPatient = $data;

?>

<div class="container">
    <form action="<?=SROOT?>patient/registerpost" method="post">
        <fieldset  class="scheduler-border">
            <legend  class="scheduler-border">New Patient Registration</legend>

            <div class="form-group">
                <input type="hidden" class="form-control" id="bookId" value='<?= 4 ?>'  name="role_id">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value='' placeholder="Your name" name="name">
            </div>
            <div class="form-group">
                <label for="author">Health Card Number</label>
                <input type="text" class="form-control" id="author" value='' placeholder="Health Card No" name="healthCardNumber">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" value='' placeholder="Date of birth" name="dob">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" id="gender" value='' placeholder="Gender" name="gender">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" value='' placeholder="Phone number" name="phone">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value='' placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" value='' placeholder="Address" name="address">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </fieldset>
    </form>
</div>

<?php
$this->end();
?>
