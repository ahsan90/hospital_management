<?php
$this->setSiteTitle('New Patient Register');

$this->start('body');

$newPatient = $data;

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
    <form action="<?=SROOT?>patient/registerpost" method="post" class="">
        <fieldset  class="scheduler-border">
            <legend  class="scheduler-border">New Patient Registration</legend>

            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" value='' placeholder="Your name" name="username" required>
            </div>
            <div class="form-group">
                <label for="author">Password</label>
                <input type="password" class="form-control" id="author" value='' placeholder="Password" name="password" required>
            </div>


            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value='' placeholder="Your name" name="name" required>
            </div>
            <div class="form-group">
                <label for="author">Health Card Number</label>
                <input type="text" class="form-control" id="author" value='' placeholder="Health Card No" name="healthCardNumber" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" value='' placeholder="Date of birth" name="dob" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>

                <select class="form-control" name="gender">
                    <option value="Male" selected="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" value='' placeholder="Phone number" name="phone" >
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


<?php
$this->end();
?>
