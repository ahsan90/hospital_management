<?php $this->setSiteTitle("Admin"); ?>
<?php $this->start('body'); ?>

    <h2>Welcome to admin Panel</h2>

    <div class="container">
        <a href="<?=SROOT?>admin/userList">Manage users</a><br>
        <a href="<?=SROOT?>admin/doctorList">Manage Doctors</a><br>
        <a href="<?=SROOT?>admin/nurseList">Manage Nurses</a><br>
        <a href="<?=SROOT?>admin/patientList">Manage Patients</a>
    </div>

<?php $this->end(); ?>