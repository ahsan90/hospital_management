<?php $this->setSiteTitle("Edit doctor's profile"); ?>
<?php $this->start('body'); ?>

<h2>Edit doctors profile</h2>

    <?php
        $roles = Role::all();
        $doctor = $data;
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
        <form action="<?=SROOT?>doctor/update/<?=$doctor->id?>" method="post">
            <fieldset  class="scheduler-border">
                <legend  class="scheduler-border">Edit doctor's profile</legend>

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" value='<?=$doctor->username?>' placeholder="Your name" name="username" >
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
                            if ($role->roleType == "doctor"){
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
                    <input type="text" class="form-control" id="name" value='<?=$doctor->name?>' placeholder="Your name" name="name">
                </div>
                <div class="form-group">
                    <label for="dob">Specialization</label>
                    <input type="text" class="form-control" id="dob" value='<?=$doctor->specialization?>' placeholder="Specialization" name="specialization">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>

                    <select class="form-control" name="gender">
                        <option value="Male" selected='<?=$doctor->gender?>'>Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" value='<?=$doctor->phone?>' placeholder="Phone number" name="phone" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value='<?=$doctor->email?>' placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" value='<?=$doctor->address?>' placeholder="Address" name="address">
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add profile</button>
                </div>
            </fieldset>
        </form>
    </div>


<?php $this->end(); ?>