<?php $this->setSiteTitle("Admin"); ?>
<?php $this->start('body'); ?>

    <div id="admin">

        <div class="mt-3">
            <?php if (isset($_SESSION['msg']) || $msg != "" || isset($_REQUEST['msg'])){
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
        </div>
        <h2>Welcome to Admin Panel</h2>
        <?php $user = $data ?>
        <form method="post" action="<?=SROOT?>admin/editpost/<?=$user->id?>">
            <div class="form-group">
                <label for="username">Update your username</label>
                <input type="text" value="<?=$user->username?>" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Enter a new password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


<?php $this->end(); ?>