<?php $this->start('body'); ?>

<?php $this->setSiteTitle('About the project');?>

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

<h1 class="text-center green">Welcome to DOUH Health care system...</h1>
<div class="about">
    <h2>Team Members</h2>
    <table class="table-striped mb-4 table-bordered table-hover table-warning mx-auto">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role in the Project</th>
                <th>Email</th>
                <th>Cell</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gileber Obodo</td>
                <td>Project Manager</td>
                <td>gobodo@hollandcollege.com</td>
                <td>+1 (902) 394-5944</td>
            </tr>
            <tr>
                <td>Kapil Upadhyaya</td>
                <td>System Analyst</td>
                <td>kupadhyaya@hollandcollege.com</td>
                <td>+1 (902) 314-3860</td>
            </tr>

            <tr>
                <td>Amro Daas</td>
                <td>System Analyst & Developer</td>
                <td>adaas120875@hollandcollege.com</td>
                <td>+1 (437) 984-0600</td>
            </tr>

            <tr>
                <td>Md Ahsanul Hoque</td>
                <td>Programmer Analyst</td>
                <td>ahrony@gmail.com</td>
                <td>+1 (902) 940-7978</td>
            </tr>
        </tbody>
    </table>

    <h2>Admin Login Credentials</h2>
    <table class="table table-hover table-danger table-bordered">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>cisAdmin</td>
            <td>cispass</td>
        </tr>
        </tbody>
    </table>

    <h2 class="mt-2">Default Doctor Login Credentials</h2>
    <table class="table table-primary table-bordered">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>johnd</td>
            <td>123</td>
        </tr>
        </tbody>
    </table>

    <h2>Default Nurse Login Credentials</h2>
    <table class="table table-dark table-bordered">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>jenj</td>
            <td>123</td>
        </tr>
        </tbody>
    </table>

    <h2>Default Patient Login Credentials with Health Card Number</h2>
    <table class="table table-info table-bordered">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Health Card Number</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>patrick</td>
            <td>123</td>
            <td>11111111</td>
        </tr>

        </tbody>
    </table>

    <div class="mb-2">
        <p class="mt-2 text-danger text-left">*Run "php updateDB.php" command to get these default login credential pre-existed in your database</p>
    </div>
</div>
<?php $this->end(); ?>



