<?php $this->setSiteTitle("Admin - Home"); ?>
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



    <div class="content mt-3">
        <a href="<?=SROOT?>admin/userList" class="btn btn-outline-primary btn-block"><i class="fa fa-cog fa-spin fa-fw"></i>&nbsp;Manage users</a><br>
        <a href="<?=SROOT?>doctor/listing" class="btn btn-outline-secondary btn-block"><i class="fa fa-cog fa-spin fa-fw"></i>&nbsp;Manage Doctors</a><br>
        <a href="<?=SROOT?>nurse/listing" class="btn btn-outline-info btn-block"><i class="fa fa-cog fa-spin fa-fw"></i>&nbsp;Manage Nurses</a><br>
        <a href="<?=SROOT?>patient/listing" class="btn btn-outline-dark btn-block"><i class="fa fa-cog fa-spin fa-fw"></i>&nbsp;Manage Patients</a>
    </div>
</div>


<?php $this->end(); ?>