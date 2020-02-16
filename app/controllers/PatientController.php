<?php


class PatientController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function registerAction(){
        if (LoginHelper::isACurrentPatient()){
            Router::redirect('patient/profile/'.UserHelper::getCurrentLoggedInPatient()->id);
        }
        $patient = new Patient();
        $this->view->render('patient/register', $patient);
    }

    public function registerPostAction(){
        if (LoginHelper::isACurrentPatient()){
            Router::redirect('patient/profile/'.UserHelper::getCurrentLoggedInPatient()->id);
        }
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

    //Go to patient profile
    public function profileAction($id){
        if (LoginHelper::isACurrentDoctor() || !LoginHelper::isLoggedIn()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }

        //Make sure if a patient loggedIn he/she is only able to access his/her own profile
        if (LoginHelper::isACurrentPatient()){

            if ($id != UserHelper::getCurrentLoggedInPatient()->id){
                Router::redirect('patient/profile/'.UserHelper::getCurrentLoggedInPatient()->id, '<p class="alert alert-danger">Unauthorized</p>');
            }
            //$id = UserHelper::getCurrentLoggedInPatient()->id;
        }
        $this->view->render('patient/profile', Patient::all()->find($id));
    }

    //List all the patients
    public function listingAction(){
        if (!LoginHelper::isAdmin()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }
        $this->view->render('patient/list', Patient::all());
    }

    //Edit patient profile
    public function editAction($id){
        if (LoginHelper::isACurrentDoctor() || !LoginHelper::isLoggedIn()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }
        //$patient = Patient::all()->find($id)->first();
        $this->view->render('patient/edit', Patient::all()->find($id));
    }

    public function updateAction($id){
        if (LoginHelper::isACurrentDoctor() || !LoginHelper::isLoggedIn()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }


        $name = Input::get('name');
        $healCardNumber = Input::get('healthCardNumber');
        $dob = Input::get('dob');
        $gender = Input::get('gender');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $address = Input::get('address');

        //Find the patient
        $patient = Patient::all()->find($id);

        //Update information
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

    public function deleteAction($id){
        if (!LoginHelper::isAdmin()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }
        $user_id = Patient::all()->find($id)->user_id;

        //Delete both associated login account and doctor's account
        $user = User::all()->find($user_id);
        $nurse = Patient::all()->find($id);
        $user->delete();
        $nurse->delete();

        $_SESSION['msg'] = "<p class='alert alert-danger'>Record deleted successfully</p>";

        //session_destroy();
        Router::redirect('admin/index');
    }

    //Show show medical record
    public function medicalRecordAction($id){
        $this->addRestrictionToMedInfo();
        //dnd($id);
        $this->view->render('patient/med_record', $id);
    }

    //Create medical record
    public function create_med_recordAction($id){
        $this->addRestrictionToMedInfo();
        //dnd($id);
        $this->view->render('patient/create_med_record', $id);
    }

    //update medical record
    public function create_med_record_postAction($id){
        if ($_POST){
            $this->addRestrictionToMedInfo();
            //dnd($id);
            $blood_pressure = Input::get('blood_pressure');
            $weight = Input::get('weight');
            $height = Input::get('height');
            $pulseRate = Input::get('pulseRate');

            if (LoginHelper::isACurrentNurse()){
                $nurseNote = Input::get('nurseNotes');
            }
            if (LoginHelper::isACurrentDoctor()){
                $diagnose = Input::get('diagnose');
            }

            $medicalRecord = new MedicalRecord();
            $medicalRecord->blood_pressure = $blood_pressure;
            $medicalRecord->weight = $weight;
            $medicalRecord->height = $height;
            $medicalRecord->pulseRate = $pulseRate;
            if (LoginHelper::isACurrentNurse()){
                $medicalRecord->nurseNotes = $nurseNote;
            }
            if (LoginHelper::isACurrentDoctor()){
                $medicalRecord->diagnose = $diagnose;
            }
            $medicalRecord->patient_id = $id;

            $medicalRecord->save();

            Router::redirect('patient/medicalRecord/'.$medicalRecord->patient_id, '<p>Information saved successfully...!</p>');
        }else{
            Router::redirect('patient/create_med_record/'.$id);
        }
    }

    //edit medical record
    public function edit_med_recordAction($id){
        $this->view->render('patient/edit_med_record', $id);
    }
    //update medical record
    public function update_med_record_postAction($id){
        $this->addRestrictionToMedInfo();
        //dnd($id);
        $medicalRecord = MedicalRecord::all()->find($id);
        if ($_POST){
            $blood_pressure = Input::get('blood_pressure');
            $weight = Input::get('weight');
            $height = Input::get('height');
            $pulseRate = Input::get('pulseRate');

            if (LoginHelper::isACurrentNurse()){
                $nurseNote = Input::get('nurseNotes');
            }
            if (LoginHelper::isACurrentDoctor()){
                $diagnose = Input::get('diagnose');
            }

            //$medicalRecord = new MedicalRecord();
            $medicalRecord->blood_pressure = $blood_pressure;
            $medicalRecord->weight = $weight;
            $medicalRecord->height = $height;
            $medicalRecord->pulseRate = $pulseRate;
            if (LoginHelper::isACurrentNurse()){
                $medicalRecord->nurseNotes = $nurseNote;
            }
            //dnd($medicalRecord->nurseNotes);
            if (LoginHelper::isACurrentDoctor()){
                $medicalRecord->diagnose = $diagnose;
            }
            //$medicalRecord->patient_id = $id;

            $medicalRecord->save();

            Router::redirect('patient/medicalRecord/'.$medicalRecord->patient_id, '<p class="alert alert-success">Information updated successfully...!</p>');
        }else{
            Router::redirect('patient/edit_med_record/'.$id);
        }
        //$this->view->render('patient/med_record');
    }

    //Add restriction to patients' medical information other than a doctor or a nurse
    private function addRestrictionToMedInfo(){
        if (LoginHelper::isACurrentPatient() || !LoginHelper::isLoggedIn()){
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized........!!</p>');
        }
    }
}