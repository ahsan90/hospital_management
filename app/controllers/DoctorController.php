<?php


class DoctorController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    //Create a doctor's account
    public function createAction(){
        $this->view->render('doctor/create');
    }

    //Create a new doctor' account post action
    public function createPostAction(){
        if ($_POST){
            $username = Input::get('username');
            $password = Input::get('password');
            $role_id = (int)Input::get('role_id');


            $name = Input::get('name');
            $specialization = Input::get('specialization');

            $gender = Input::get('gender');
            $phone = Input::get('phone');
            $email = Input::get('email');
            $address = Input::get('address');

            //$data = [$role_id, $name, $healCardNumber, $dob, $gender, $phone, $email, $address, $username, $password];
            //$user = User::all()->where('username', $username)->first();

            if (Validation::isUserExists($username)){
                $_SESSION['msg'] = "<p class='alert-warning'>Username already exists</p>";
                Router::redirect('doctor/create');
            }
            if (Doctor::isValidDoctorData($role_id, $name, $gender,$specialization,$phone,$email, $address, $username, $password)){
                $_SESSION['msg'] = "<p class='alert alert-success'>New Doctor's Account Added</p>";

                $user_id = UserHelper::findUserIdByUsername($username);
                $doctor_id = Doctor::all()->where('user_id', $user_id)->first()->id;

                Router::redirect('doctor/profile/'.$doctor_id);
            }else{
                $_SESSION['msg'] = "<p class='alert alert-danger'>Form contains erros</p>";
                Router::redirect('doctor/create');
            }
        }else{
            Router::redirect('doctor/create');
        }
    }

    //Visit doctor's profile
    public function profileAction($id){
        $this->view->render('doctor/profile', Doctor::all()->find($id));
    }

    //List all available doctors
    public function listingAction(){
        $this->view->render('doctor/list', Doctor::all());
    }

	public function editAction($id){
        $this->view->render('doctor/edit', Doctor::all()->find($id));
    }

    //Update doctors's information based on the form inputs
    public function updateAction($id){
        $username = Input::get('username');
        $password = Input::get('password');
        $role_id = (int)Input::get('role_id');


        $name = Input::get('name');
        $specialization = Input::get('specialization');

        $gender = Input::get('gender');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $address = Input::get('address');

        //Check validation
        if (!Validation::isEmpty($role_id) && !Validation::isEmpty($name)
            && !Validation::isEmpty($specialization)
            && !Validation::isEmpty($username) && !Validation::isEmpty($password) && !Validation::isEmpty($gender)
            && !Validation::isEmpty($phone) && Validation::isValidEmail($email)
            && !Validation::isEmpty($address)){

            //find user_id associated with the doctor
            $user_id = Doctor::all()->find($id)->user_id;

            //Find the associated user
            $user = User::all()->find($user_id);

            $user->username = $username;
            $user->password = $password;
            $user->role_id = $role_id;
            //update users
            $user->update();

            //Update doctors information
            $doctor = Doctor::all()->find($id);
            $doctor->role_id = $role_id;
            $doctor->user_id = $user_id;
            $doctor->name = $name;
            $doctor->gender = $gender;
            $doctor->specialization = $specialization;
            $doctor->phone = $phone;
            $doctor->email = $email;
            $doctor->address = $address;
            $doctor->save();

            $_SESSION['msg'] = "<p class='alert alert-success'>Information updated successfully</p>";
            Router::redirect('doctor/profile/'.$id);

        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Forms contains errors</p>";
            Router::redirect('doctor/edit');
        }
    }

    //Delete docotor's account
    public function deleteAction($id){
        $user_id = Doctor::all()->find($id)->user_id;

        //Delete both associated login account and doctor's account
        $user = User::all()->find($user_id);
        $doctor = Doctor::all()->find($id);
        $user->delete();
        $doctor->delete();

        $_SESSION['msg'] = "<p class='alert alert-danger'>Record deleted successfully</p>";

        session_destroy();
        Router::redirect('home/index');

    }
}