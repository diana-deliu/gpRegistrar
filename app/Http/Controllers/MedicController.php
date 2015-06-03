<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateConsultRequest;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
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
    public function viewPatient()
    {
        $patients = $this->getPatients(20);

        return view('medic.viewpatient', compact('patients'));
    }

    private function getDataFromCNP($cnp, &$sex, &$birthDate, &$age) {
        if ($cnp[0] == 1) {
            $sex = 'masculin';
        }
        else {
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

        return redirect('medic/view_patient')->with([
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

    /*public function optionalParam()
    {
        return view('medic.optionalparam');
    }*/

    public function buttonsPatient($id)
    {
        $patient = Patient::find($id);
        $patient = $this->patientToArray($patient);
       return view('medic.patientbuttons', compact('patient'));
   }

    public function addConsult($id)
    {
        $patient = Patient::find($id);
        $patient = $this->patientToArray($patient);
        return view('medic.addconsult', compact('patient'));
    }

    public function createConsult(CreateConsultRequest $request)
    {

        $result = Patient::create($request->all());

        if ($result == 0) {
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
}