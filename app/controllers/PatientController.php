<?php


class PatientController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function registerAction(){
        $patient = new Patient();
        $this->view->render('patient/register', $patient);
    }

    public function registerPostAction(){
        if ($_POST){
            $username = Input::get('username');
            $password = Input::get('password');
            $role_id = Role::all()->where('roleType', 'patient')->first()->id;


            $name = Input::get('name');
            $healCardNumber = Input::get('healthCardNumber');
            $dob = Input::get('dob');
            $gender = Input::get('gender');
            $phone = Input::get('phone');
            $email = Input::get('email');
            $address = Input::get('address');

            //$data = [$role_id, $name, $healCardNumber, $dob, $gender, $phone, $email, $address, $username, $password];

            $user = User::all()->where('username', $username)->first();

            if ($user){
                $_SESSION['msg'] = "<p class='alert-warning'>Username already exists</p>";
                Router::redirect('patient/register');
            }

            if (Validation::isHealthCardExists($healCardNumber)){
                $_SESSION['msg'] = "<p class='alert-warning'>Health Card number already exists</p>";
                Router::redirect('patient/register');
            }

            //Patient::saveValidPatientInfo($role_id, $name, $healCardNumber, $dob, $gender, $phone, $email, $address, $username, $password);
            if(Patient::isValidPatientData($role_id, $name, $healCardNumber, $dob, $gender, $phone, $email, $address, $username, $password)){

                $msg = "<p class='alert alert-success'>Information saved successfully</p>";
                //Find the user id of newly saved patient
                $user_id = UserHelper::findUserIdByUsername($username);

                //Find patient based on the user id
                $patient_id = Patient::all()->where('user_id', $user_id)->first()->id;

                $_SESSION['msg'] = $msg;

                //$redirect_uri = 'patient/profile/'.$patient_id;

                Router::redirect('patient/profile/'.$patient_id);

            }else{
                $_SESSION['msg'] = "<p class='alert alert-danger'>Form contains error</p>";
                Router::redirect('patient/register');
            }

        }else{
            $msg = "Not posted";
            //$this->view->render('patient/register');
            Router::redirect('patient/register');
        }
    }

    public function profileAction($id){
        $this->view->render('patient/profile', Patient::all()->find($id));
    }
    public function listingAction(){
        $this->view->render('patient/list', Patient::all());
    }

    public function editAction($id){
        //$patient = Patient::all()->find($id)->first();
        $this->view->render('patient/edit', Patient::all()->find($id));
    }

    public function updateAction($id){
        $name = Input::get('name');
        $healCardNumber = Input::get('healthCardNumber');
        $dob = Input::get('dob');
        $gender = Input::get('gender');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $address = Input::get('address');

        $patient = Patient::all()->find($id);

        $patient->name = $name;
        $patient->healthCardNumber = $healCardNumber;
        $patient->dob = $dob;
        $patient->gender = $gender;
        $patient->phone = $phone;
        $patient->email = $email;
        $patient->address = $address;

        $patient->save();

        $_SESSION['msg'] = "<p class='alert alert-success'>Information saved successfully</p>";
        Router::redirect('patient/profile/'.$id);
    }
}