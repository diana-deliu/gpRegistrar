<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateConsultRequest;
use App\Http\Requests\CreateLabRequest;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdateConsultRequest;
use App\Http\Requests\UpdateLabRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Lab;
use App\Patient;
use App\Services\Registrar;
use DateTime;
use Illuminate\Http\Request;

class MedicController extends Controller
{

    public function __construct()
    {
        $this->middleware('medic');
    }

    private function createUser($request, $registrar)
    {
        return $registrar->create($request);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function addPatient()
    {
        return view('medic.addpatient');
    }

    public function createPatient(CreatePatientRequest $request, Registrar $registrar)
    {
        $userRequest = array_only($request->all(), ['email', 'password']);
        $userRequest['role'] = 'patient';
        $user = $this->createUser($userRequest, $registrar);

        $patientRequest = array_only($request->all(), ['cnp', 'lastname', 'firstname', 'address']);
        $patientRequest['user_id'] = $user->id;

        Patient::create($patientRequest);

        return redirect('/')->with([
            'flash_message' => 'Pacientul a fost adăugat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewPatients()
    {
        $patients = $this->getPatients(20);

        return view('medic.viewpatients', compact('patients'));
    }

    private function getDataFromCNP($cnp, &$sex, &$birthDate, &$age)
    {
        if ($cnp[0] == 1) {
            $sex = 'masculin';
        } else {
            $sex = 'feminin';
        }
        $format = 'ymd';
        $date = substr($cnp, 1, 6);
        $birthDate = date_create_from_format($format, $date);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;

        $birthDate = $birthDate->format('d.m.Y');
    }

    private function patientToArray($patient)
    {
        $item = array_except($patient->toArray(), ['created_at']);
        $item['email'] = $patient->user->email;
        $this->getDataFromCNP($item['cnp'], $sex, $birthDate, $age);
        $item['sex'] = $sex;
        $item['birthDate'] = $birthDate;
        $item['age'] = $age;

        return $item;
    }

    private function patientToArrayAjax($patient)
    {
        $patientArray = $patient->toArray();
        $item['id'] = $patientArray['id'];
        $item['value'] = $patientArray['cnp'] . ' ' . $patientArray['firstname'] . ' ' . $patientArray['lastname'];

        return $item;
    }

    private function getPatientsAjax($number)
    {
        $patients_objects = Patient::all()->take($number)->all();

        $patients = [];

        foreach ($patients_objects as $patient) {

            $patients[] = $this->patientToArrayAjax($patient);

        }

        return $patients;
    }

    private function getPatients($number)
    {
        $patients_objects = Patient::all()->take($number)->all();

        $patients = [];

        foreach ($patients_objects as $patient) {

            $patients[] = $this->patientToArray($patient);

        }

        return $patients;
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editPatient($id)
    {
        $patient = Patient::find($id);
        $patient = $this->patientToArray($patient);

        return view('medic.editpatient', compact('patient'));
    }

    public function updatePatient($id, UpdatePatientRequest $request)
    {
        $patient = Patient::find($id);
        $user = $patient->user();

        $patient->update(array_only($request->all(), ['cnp', 'lastname', 'firstname', 'address']));
        $user->update(array_only($request->all(), ['email']));

        return redirect('medic/view_patients')->with([
            'flash_message' => 'Pacientul a fost editat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function removePatient($id)
    {
        $patient = Patient::find($id);
        $user = $patient->user();

        $patient->delete();
        $user->delete();

        return redirect('medic/view_patient')->with([
            'flash_message' => 'Pacientul a fost șters cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    function return_bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }

    function max_file_upload_in_bytes()
    {
        //select maximum upload size
        $max_upload = $this->return_bytes(ini_get('upload_max_filesize'));
        //select post limit
        $max_post = $this->return_bytes(ini_get('post_max_size'));
        //select memory limit
        $memory_limit = $this->return_bytes(ini_get('memory_limit'));
        // return the smallest of them, this defines the real limit
        return min($max_upload, $max_post, $memory_limit);
    }


    public function importPatient()
    {
        $maxFileSize = $this->max_file_upload_in_bytes() / (1024 * 1024);
        return view('medic.importpatient', compact('maxFileSize'));
    }

    public function patientDetails($id)
    {
        $patient = Patient::find($id);
        $patient = $this->patientToArray($patient);
        return view('medic.patientdetails', compact('patient'));
    }


    public function createConsult(CreateConsultRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $result = Consult::create($requestAll);

        if (is_null($result)) {
            return redirect('/')->with([
                'flash_message' => 'Consultația nu a putut fi adăugată!',
                'flash_message_type' => 'alert-danger'
            ]);
        }

        return redirect('/')->with([
            'flash_message' => 'Consultația a fost adăugată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @param $patient_id
     * @return \Illuminate\View\View
     */
    public function viewPatientHistory($patient_id)
    {
        $patient = Patient::find($patient_id);
        $consult_objects = $patient->consults;
        $consults = [];
        foreach ($consult_objects as $consult) {
            $consults[] = $this->consultToArray($consult);
        }
        return view('medic.viewpatienthistory', compact('consults'));
    }

    private function getConsults($number)
    {

        $consults_objects = Consult::all()->take($number)->all();

        $consults = [];

        foreach ($consults_objects as $consult) {

            $consults[] = $this->consultToArray($consult);

        }

        return $consults;
    }

    private function consultToArray($consult)
    {
        $item = array_except($consult->toArray(), ['created_at', 'updated_at']);
        $patient = $consult->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;

        return $item;
    }

    /*public function updateConsult($id, UpdateConsultRequest $request)
    {
        $patient = Patient::find($id);
        $user = $patient->user();

        $patient->update(array_only($request->all(), ['cnp', 'lastname', 'firstname', 'address']));
        $user->update(array_only($request->all(), ['email']));

        return redirect('medic/view_consults')->with([
            'flash_message' => 'Pacientul a fost editat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }*/

    /**
     * @return \Illuminate\View\View
     */
    public function viewGeneralConsults()
    {
        $consults = $this->getConsults(20);

        return view('medic.viewgeneralconsults', compact('consults'));
    }

    public function consultDetails($id)
    {
        $consult = Consult::find($id);
        $patient = $consult->patient;
        $consult = $this->consultToArray($consult);
        $patient = $this->patientToArray($patient);

        return view('medic.consultdetails', compact('consult', 'patient'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getPatientsArray()
    {
        $patients = $this->getPatientsAjax(20);

        return $patients;
    }

    public function addConsult($id = null)
    {
        if (!is_null($id)) {
            $patient = Patient::find($id);
            $patient = $this->patientToArray($patient);
            return view('medic.addconsult', compact('patient'));
        }
        return view('medic.addconsult');

    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editConsult($id)
    {
        $consult = Consult::find($id);
        $consult = $this->consultToArray($consult);
        $patient = Patient::find($consult['patient_id']);

        return view('medic.editconsult', compact('consult', 'patient'));
    }

    public function updateConsult($id, UpdateConsultRequest $request)
    {
        $consult = Consult::find($id);

        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $consult->update($requestAll);

        return redirect('medic/view_generalconsults')->with([
            'flash_message' => 'Consultația a fost editată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function removeConsult($id)
    {
        $consult = Consult::find($id);

        $consult->delete();

        return redirect('medic/view_generalconsults')->with([
            'flash_message' => 'Consultația a fost ștearsă cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function addLab()
    {
        return view('medic.addlab');
    }

    public function createLab(CreateLabRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $result = Lab::create($requestAll);

        return redirect('medic/view_labs')->with([
            'flash_message' => 'Analizele au fost adăugate cu succes!',
            'flash_message_type' => 'alert-success'
        ]);

        if (is_null($result)) {
            return redirect('/')->with([
                'flash_message' => 'Analizele nu au putut fi adăugate!',
                'flash_message_type' => 'alert-danger'
            ]);
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewLabs()
    {
        $labs = $this->getLabs(20);

        return view('medic.viewlabs', compact('labs'));
    }

    private function getLabs($number)
    {

        $labs_objects = Lab::all()->take($number)->all();

        $labs = [];

        foreach ($labs_objects as $lab) {

            $labs[] = $this->labToArray($lab);

        }

        return $labs;
    }

    private function labToArray($lab)
    {
        $item = array_except($lab->toArray(), ['created_at', 'updated_at']);
        $patient = $lab->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;

        return $item;
    }

    public function labDetails($id)
    {
        $lab = Lab::find($id);
        $patient = $lab->patient;
        $consult = $this->consultToArray($lab);
        $patient = $this->patientToArray($patient);

        return view('medic.labdetails', compact('lab', 'patient'));
    }
    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editLab($id)
    {
        $lab = Lab::find($id);
        $lab = $this->consultToArray($lab);
        $patient = Patient::find($lab['patient_id']);

        return view('medic.editlab', compact('lab', 'patient'));
    }

    public function updateLab($id, UpdateLabRequest $request)
    {
        $lab = Lab::find($id);

        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $lab->update($requestAll);

        return redirect('medic/view_labs')->with([
            'flash_message' => 'Analizele au fost editate cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function removeLab($id)
    {
        $lab = Lab::find($id);

        $lab->delete();

        return redirect('medic/view_labs')->with([
            'flash_message' => 'Analizele au fost șterse cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

}