<?php
$this->setSiteTitle('Edit Nurse Account');

$this->start('body');

$roles = Role::all();

$nurse = $data;

$user_id = Nurse::all()->find($nurse->id)->user_id;

//Delete both associated login account and doctor's account
$user = User::all()->find($user_id);

?>

<div class="container">
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
    <form action="<?=SROOT?>nurse/update/<?=$nurse->id?>" method="post">
        <fieldset  class="scheduler-border">
            <legend  class="scheduler-border">Update nurse account</legend>

            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" value='<?=$user->username?>' placeholder="Your name" name="username" >
            </div>
            <div class="form-group">
                <label for="author">Password</label>
                <input type="password" class="form-control" id="author" value='' placeholder="Password" name="password" >
            </div>
            <div class="form-group">
                <label for="RoleType">Role Type</label>
                <select class="form-control" name="role_id">
                    <?php
                    foreach ($roles as $role){
                        if ($role->roleType == "nurse"){
                            echo "<option value='".$role->id."' selected='".$role->id."'>".$role->roleType."</option>";
                        }else{
                            echo "<option value='".$role->id."'>".$role->roleType."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value='<?=$nurse->name?>' placeholder="Your name" name="name">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender">
                    <option value="Male" selected='<?=$nurse->gender?>'>Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" value='<?=$nurse->phone?>' placeholder="Phone number" name="phone" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value='<?=$nurse->email?>' placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" value='<?=$nurse->address?>' placeholder="Address" name="address">
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Add profile</button>
            </div>
        </fieldset>
    </form>
</div>

<?php
$this->end();
?>

