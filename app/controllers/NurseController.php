<?php


class NurseController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    //create nurse account
    public function createAction(){
        //redirect if unauthorized
        self::isUnauthorized();
        $this->view->render('nurse/create');
    }

    //Create save profile after method post action
    public function createPostAction(){
        //redirect if unauthorized
        self::isUnauthorized();

        if ($_POST){
            $username = Input::get('username');
            $password = Input::get('password');
            $role_id = (int)Input::get('role_id');

            $name = Input::get('name');

            $gender = Input::get('gender');
            $phone = Input::get('phone');
            $email = Input::get('email');
            $address = Input::get('address');

            //$data = [$role_id, $name, $healCardNumber, $dob, $gender, $phone, $email, $address, $username, $password];
            //$user = User::all()->where('username', $username)->first();

            if (Validation::isUserExists($username)){
                $_SESSION['msg'] = "<p class='alert-warning'>Username already exists</p>";
                Router::redirect('nurse/create');
            }
            if (Nurse::isValidNurseData($role_id, $name, $gender, $phone,$email, $address, $username, $password)){
                $_SESSION['msg'] = "<p class='alert alert-success'>New Nurse Account Added</p>";

                $user_id = UserHelper::findUserIdByUsername($username);
                $nurse_id = Nurse::all()->where('user_id', $user_id)->first()->id;

                Router::redirect('nurse/profile/'.$nurse_id);
            }else{
                $_SESSION['msg'] = "<p class='alert alert-danger'>Form contains erros</p>";
                Router::redirect('nurse/create');
            }
        }else{
            Router::redirect('nurse/create');
        }
    }

    public function profileAction($id){
        $this->view->render('nurse/profile', Nurse::all()->find($id));
    }

    //list all nurse
    public function listingAction(){
        if (!LoginHelper::isAdmin()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized Access...</p>');
        }
        $this->view->render('nurse/list', Nurse::all());
    }

    //edit nurse profile
    public function editAction($id){
        $this->view->render('nurse/edit', Nurse::all()->find($id));
    }

    //update nurse profile
    public function updateAction($id){
        self::isUnauthorized();
        $username = Input::get('username');
        $password = Input::get('password');
        $role_id = (int)Input::get('role_id');


        $name = Input::get('name');

        $gender = Input::get('gender');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $address = Input::get('address');

        //Check validation
        if (!Validation::isEmpty($role_id) && !Validation::isEmpty($name)
            && !Validation::isEmpty($username) && !Validation::isEmpty($gender)
            && !Validation::isEmpty($phone) && Validation::isValidEmail($email)
            && !Validation::isEmpty($address)){

            //find user_id associated with the nurse
            $user_id = Nurse::all()->find($id)->user_id;

            //Find the associated user
            $user = User::all()->find($user_id);

            $user->username = $username;

            if (!Validation::isEmpty($password)){
                $user->password = md5($password);
            }
            $user->role_id = $role_id;
            //update users
            $user->update();

            //Update doctors information
            $nurse = Nurse::all()->find($id);
            $nurse->role_id = $role_id;
            $nurse->user_id = $user_id;
            $nurse->name = $name;
            $nurse->gender = $gender;
            $nurse->phone = $phone;
            $nurse->email = $email;
            $nurse->address = $address;
            $nurse->update();

            $_SESSION['msg'] = "<p class='alert alert-success'>Information updated successfully</p>";
            Router::redirect('nurse/profile/'.$id);

        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Forms contains errors</p>";
            Router::redirect('nurse/edit/'.$id);
        }
    }

    //Delete nurse account
    public function deleteAction($id){
        //self::isUnauthorized();
        if (!LoginHelper::isAdmin()){
            if (LoginHelper::isACurrentNurse()){
                Router::redirect('nurse/profile/'.UserHelper::getCurrentLoggedInNurse()->id, '<p class="alert alert-danger">You are not authorized to delete your account. Please contact admin</p>');
            }else{
                Router::redirect('home', '<p>Unauthorized</p>');
            }
        }
        $user_id = Nurse::all()->find($id)->user_id;

        //Delete both associated login account and doctor's account
        $user = User::all()->find($user_id);
        $nurse = Nurse::all()->find($id);
        $user->delete();
        $nurse->delete();

        $_SESSION['msg'] = "<p class='alert alert-danger'>Record deleted successfully</p>";

        //session_destroy();

        Router::redirect('admin', '<p class="alert alert-success">Account deleted</p>');
    }

    //determine if unauthorized access
    private static function isUnauthorized(){
        if (LoginHelper::isACurrentDoctor() || LoginHelper::isACurrentPatient()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }
    }
}