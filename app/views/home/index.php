<?php $this->start('body'); ?>

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

<div class="jumbotron-fluid">
    <h1 class="text-center green">Welcome to DOUH Health care system...</h1>
</div>

<?php $this->end(); ?>


