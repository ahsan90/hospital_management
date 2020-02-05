<?php
$this->setSiteTitle('Doctor Profile');

$this->start('body');




?>

    <div class="login-form mt-2 mb-5">
    <?php
        if (isset($_SESSION['msg']) || $msg != "" || isset($_REQUEST['msg'])){
            if (isset($_SESSION['msg']))
            {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }elseif ($msg != null){
                echo "<div>".$msg."</div>";
            }
            elseif (isset($_REQUEST['msg'])){
                echo $_REQUEST['msg'];
                unset($_REQUEST['msg']);
            }
        }
    ?>
        <form method="post" action="<?=SROOT?>auth/loginpost">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Login</legend>
                <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Your Username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                </div>
                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
            </fieldset>
        </form>
    </div>

<?php
$this->end();
?>