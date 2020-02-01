<?php
$this->setSiteTitle('Doctor Profile');

$this->start('body');
?>

<div class="login-form mt-2 mb-5">
    <form method="post" action="<?=SROOT?>auth/userPost">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Create your login credential</legend>
            <div class="form-group">
                <label for="userName">Username</label>
                <input type="text" class="form-control" id="" placeholder="Enter Your Username" name="userName" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
        </fieldset>
    </form>
</div>

<?php
$this->end();
?>