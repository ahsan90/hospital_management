<?php $this->start('body'); ?>

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

<h1 class="text-center red">Welcome to DOUH Health care system...</h1>
<?php $this->end(); ?>


