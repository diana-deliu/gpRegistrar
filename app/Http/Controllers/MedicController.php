<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateConsultRequest;
use App\Http\Requests\CreateSurveyRequest;
use App\Http\Requests\CreateTreatmentRequest;
use App\Http\Requests\CreateLabRequest;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\CreateVaccineRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\UpdateConsultRequest;
use App\Http\Requests\UpdateLabRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Lab;
use App\Medic;
use App\Patient;
use App\Services\Registrar;
use App\Survey;
use App\SurveyQuestion;
use App\Treatment;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Exception\Exception;

class MedicController extends Controller
{
    /* Helpers */
    private $categories = [
        '0' => 'sugar',
        '1' => 'gravidă',
        '2' => 'antirabic',
        '3' => 'antitetanos',
        '4' => 'HPV',
        '5' => 'poliomielitic',
        '6' => 'antigripal'
    ];

    private $diagnosis = [
        '0' => 'anemie',
        '1' => 'hipertensiune arterială',
        '2' => 'rabie',
        '3' => 'varicelă',
        '4' => 'oreion',
        '5' => 'apendicită',
        '6' => 'chist ovarian',
        '7' => 'dismenoree'
    ];

    private $treatments = [
        '0' => 'Algocalmin',
        '1' => 'Nurofen Forte',
        '2' => 'Nurofen Immedia',
        '3' => 'Klacid',
        '4' => 'Proctolog',
        '5' => 'Paracetamol',
        '6' => 'Progesteron',
        '7' => 'Coldrex'
    ];

    public function __construct()
    {
        $this->middleware('medic');
    }

    private function createUser($request, $registrar)
    {
        return $registrar->create($request);
    }

    /****************** Patient related ******************/
    /**
     * @return \Illuminate\View\View
     */
    public function addPatient()
    {
        return view('medic.addpatient');
    }

    public function createPatient(CreatePatientRequest $request, Registrar $registrar)
    {
        $userRequest = array_only($request->all(), ['email']);
        $userRequest['role'] = 'patient';
        $user = $this->createUser($userRequest, $registrar);

        $patientRequest = array_only($request->all(), ['cnp', 'lastname', 'firstname', 'address']);
        $patientRequest['user_id'] = $user->id;
        $patientRequest['medic_id'] = Medic::where('user_id', '=', Auth::user()->id)->firstOrFail()->id;

        $result = Patient::create($patientRequest);
        if (is_null($result)) {
            return redirect('medic/add_patient')->with([
                'flash_message' => 'Pacientul a fost adăugat cu succes!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($request->all());
        }
        return redirect('medic/view_patients')->with([
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

    public function importPatientForm()
    {
        $maxFileSize = $this->max_file_upload_in_bytes() / (1024 * 1024);
        return view('medic.importpatient', compact('maxFileSize'));
    }

    public function importPatient(ImportRequest $request, Registrar $registrar)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('uploads', $fileName);

        $results = Excel::load('uploads/' . $fileName, function ($reader) {
        })->get();
        $i = 0;
        foreach ($results->all() as $item) {
            try {


                $patientData = $item->all();
                if (!filter_var($patientData['e_mail'], FILTER_VALIDATE_EMAIL)) {
                    return redirect('medic/view_patients')->with([
                        'flash_message' => 'E-mail invalid pentru pacientul ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                        'flash_message_type' => 'alert-danger'
                    ]);
                }
                $userRequest['email'] = trim($patientData['e_mail']);
                $userRequest['role'] = 'patient';
                $user = $this->createUser($userRequest, $registrar);

                if (!$user) {
                    return redirect('medic/view_patients')->with([
                        'flash_message' => 'Eroare importare pacient ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                        'flash_message_type' => 'alert-danger'
                    ]);
                }

                if (strlen(trim($patientData['cnp'])) != 13) {
                    return redirect('medic/view_patients')->with([
                        'flash_message' => 'CNP invalid pentru pacientul ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                        'flash_message_type' => 'alert-danger'
                    ]);
                }
                $patientRequest['cnp'] = trim($patientData['cnp']);
                if (strlen(trim($patientData['prenume'])) < 2 || strlen(trim($patientData['nume'])) < 2 || strlen(trim($patientData['adresa'])) < 2) {
                    return redirect('medic/view_patients')->with([
                        'flash_message' => 'Câmpurile nume, prenume şi adresă trebuie să aibă minim 2 caractere pentru pacientul ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                        'flash_message_type' => 'alert-danger'
                    ]);
                }
                $patientRequest['firstname'] = trim($patientData['prenume']);
                $patientRequest['lastname'] = trim($patientData['nume']);
                $patientRequest['address'] = trim($patientData['adresa']);
                $patientRequest['user_id'] = $user->id;
                $patientRequest['medic_id'] = Medic::where('user_id', '=', Auth::user()->id)->firstOrFail()->id;

                $patient = Patient::create($patientRequest);

                if (!$patient) {
                    return redirect('medic/view_patients')->with([
                        'flash_message' => 'Eroare importare pacient ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                        'flash_message_type' => 'alert-danger'
                    ]);
                }

                $i++;
            } catch (Exception $e) {
                return redirect('medic/view_patients')->with([
                    'flash_message' => 'Eroare importare pacient ' . $i . '. Restul pacienţilor au fost ignoraţi!',
                    'flash_message_type' => 'alert-danger'
                ]);
            }
        }

        unlink('uploads/' . $fileName);

        return redirect('medic/view_patients')->with([
            'flash_message' => 'Au fost importati ' . $results->count() . ' pacienti!',
            'flash_message_type' => 'alert-success'
        ]);

    }

    public function exportPatient()
    {
        $filename = 'Pacienti'.date('_d_m_Y');
        Excel::create($filename, function ($excel) {
            $excel->setTitle('pacienti');
            $excel->sheet('Pacienti', function ($sheet) {
                $patients = Patient::all();
                $patientsArray = [];
                foreach ($patients as $patient) {
                    $patientsArray[] = [
                        'CNP' => $patient->cnp,
                        'Prenume' => $patient->firstname,
                        'Nume' => $patient->lastname,
                        'E-mail' => $patient->user->email,
                        'Adresa' => $patient->address
                    ];
                }
                $sheet->fromArray($patientsArray);
            });
        })->download('xls');
    }

    public function patientDetails($id)
    {
        $patient = Patient::find($id);
        $patient = $this->patientToArray($patient);
        return view('medic.patientdetails', compact('patient'));
    }

    /****************** Patient related *****************/

    /****************** Consult related ***************
     * @param CreateConsultRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */

    /*
     * @param CreateConsultRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createConsult(CreateConsultRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_consult')->with([
                'flash_message' => 'Data consultaţiei viitoare trebuie să fie dupa cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        $result = Consult::create($requestAll);
        if (is_null($result)) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_consult')->with([
                'flash_message' => 'Consultația nu a putut fi adăugată!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        return redirect('medic/view_generalconsults')->with([
            'flash_message' => 'Consultația a fost adăugată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @param $patient_id
     * @return \Illuminate\View\View
     */
    public function viewPatientConsults($patient_id)
    {
        $patient = Patient::find($patient_id);
        $consult_objects = $patient->consults;
        $consults = [];
        foreach ($consult_objects as $consult) {
            $consults[] = $this->consultToArray($consult);
        }
        return view('medic.viewpatientconsults', compact('consults'));
    }

    /**
     * @param $patient_id
     * @return \Illuminate\View\View
     */
    public function viewPatientTreatments($patient_id)
    {
        $patient = Patient::find($patient_id);
        $treatment_objects = $patient->treatments;
        $treatments = [];
        foreach ($treatment_objects as $treatment) {
            $treatments[] = $this->treatmentToArray($treatment);
        }
        return view('medic.viewpatienttreatments', compact('treatments'));
    }

    /**
     * @param $patient_id
     * @return \Illuminate\View\View
     */
    public function viewPatientLabs($patient_id)
    {
        $patient = Patient::find($patient_id);
        $lab_objects = $patient->labs;
        $labs = [];
        foreach ($lab_objects as $lab) {
            $labs[] = $this->labToArray($lab);
        }
        return view('medic.viewpatientlabs', compact('labs'));
    }

    /**
     * @param $patient_id
     * @return \Illuminate\View\View
     */
    public function viewPatientVaccines($patient_id)
    {
        $patient = Patient::find($patient_id);
        $vaccine_objects = $patient->vaccines;
        $vaccines = [];
        foreach ($vaccine_objects as $vaccine) {
            $vaccines[] = $this->vaccineToArray($vaccine);
        }
        return view('medic.viewpatientvaccines', compact('vaccines'));
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
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/edit_consult/' . $id)->with([
                'flash_message' => 'Data consultaţiei viitoare trebuie să fie dupa cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

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

    /****************** Consult related *****************/

    /****************** Lab related *****************/

    public function addLab()
    {
        return view('medic.addlab');
    }

    public function createLab(CreateLabRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_lab')->with([
                'flash_message' => 'Data analizelor viitoare trebuie să fie după cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        $result = Lab::create($requestAll);

        if (is_null($result)) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_lab')->with([
                'flash_message' => 'Analizele nu au putut fi adăugate!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        return redirect('medic/view_labs')->with([
            'flash_message' => 'Analizele au fost adăugate cu succes!',
            'flash_message_type' => 'alert-success'
        ]);

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
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/edit_lab/' . $id)->with([
                'flash_message' => 'Data analizelor viitoare trebuie să fie după cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

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

    /****************** Lab related *****************/

    /****************** Vaccine related *****************/

    public function addVaccine()
    {
        $categories = $this->categories;
        return view('medic.addvaccine', compact('categories'));
    }

    public function createVaccine(CreateVaccineRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);
        if (!(isset($requestAll['notification'])) || is_null($requestAll['notification'])) {
            $requestAll['notification'] = false;
        } else {
            $requestAll['notification'] = true;
        }
        if (!(isset($requestAll['appointment'])) || is_null($requestAll['appointment'])) {
            $requestAll['appointment'] = false;
        } else {
            $requestAll['appointment'] = true;
        }

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_vaccine')->with([
                'flash_message' => 'Data vaccinării viitoare trebuie să fie dupa cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        $result = Vaccine::create($requestAll);

        if (is_null($result)) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/add_vaccine')->with([
                'flash_message' => 'Vaccinările nu au putut fi adăugate!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        return redirect('medic/view_vaccines')->with([
            'flash_message' => 'Vaccinările au fost adăugate cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewVaccines()
    {
        $vaccines = $this->getVaccines(20);

        return view('medic.viewvaccines', compact('vaccines'));
    }


    private function getVaccines($number)
    {

        $vaccines_objects = Vaccine::all()->take($number)->all();

        $vaccines = [];

        foreach ($vaccines_objects as $vaccine) {

            $vaccines[] = $this->vaccineToArray($vaccine);

        }

        return $vaccines;
    }

    private function vaccineToArray($vaccine, $makeReadable = true)
    {
        $item = array_except($vaccine->toArray(), ['created_at', 'updated_at']);
        $patient = $vaccine->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;
        if ($makeReadable) {
            $item['category'] = $this->categories[$item['category']];

            $item['notification'] = ($item['notification']) ? 'Da' : 'Nu';
            $item['appointment'] = ($item['appointment']) ? 'Da' : 'Nu';
        }

        return $item;
    }

    public function vaccineDetails($id)
    {
        $vaccine = Vaccine::find($id);
        $patient = $vaccine->patient;
        $vaccine = $this->vaccineToArray($vaccine);
        $patient = $this->patientToArray($patient);

        return view('medic.vaccinedetails', compact('vaccine', 'patient'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editVaccine($id)
    {
        $vaccine = Vaccine::find($id);
        $vaccine = $this->vaccineToArray($vaccine, false);
        $patient = Patient::find($vaccine['patient_id']);
        $categories = $this->categories;

        return view('medic.editvaccine', compact('vaccine', 'patient', 'categories'));
    }

    public function updateVaccine($id, UpdateVaccineRequest $request)
    {
        $vaccine = Vaccine::find($id);

        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);
        $requestAll['next_date'] = date_create_from_format('d.m.Y H:i', $requestAll['next_date']);

        if (!(isset($requestAll['notification'])) || is_null($requestAll['notification'])) {
            $requestAll['notification'] = false;
        } else {
            $requestAll['notification'] = true;
        }
        if (!(isset($requestAll['appointment'])) || is_null($requestAll['appointment'])) {
            $requestAll['appointment'] = false;
        } else {
            $requestAll['appointment'] = true;
        }

        if ($requestAll['next_date'] <= $requestAll['date']) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            $requestAll['next_date'] = $this->dateToStringLocaleEn($requestAll['next_date']);
            return redirect('medic/edit_vaccine/' . $id)->with([
                'flash_message' => 'Data vaccinării viitoare trebuie să fie dupa cea curentă!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }
        $vaccine->update($requestAll);

        return redirect('medic/view_vaccines')->with([
            'flash_message' => 'Vaccinarea a fost editată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function removeVaccine($id)
    {
        $vaccine = Vaccine::find($id);

        $vaccine->delete();

        return redirect('medic/view_vaccines')->with([
            'flash_message' => 'Vaccinarea a fost ștearsă cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }
    /****************** Vaccine related *****************/

    /****************** Treatment related *****************/
    public function addTreatment()
    {
        $categories = $this->categories;
        $diagnosis = $this->diagnosis;
        $treatments = $this->treatments;

        return view('medic.addtreatment', compact('categories', 'diagnosis', 'treatments'));
    }

    public function createTreatment(CreateTreatmentRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);

        if (!(isset($requestAll['appointment'])) || is_null($requestAll['appointment'])) {
            $requestAll['appointment'] = false;
        } else {
            $requestAll['appointment'] = true;
        }

        $result = Treatment::create($requestAll);

        if (is_null($result)) {
            $requestAll['date'] = $this->dateToStringLocaleEn($requestAll['date']);
            return redirect('medic/add_treatment')->with([
                'flash_message' => 'Recomandarea nu a putut fi adăugată!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        return redirect('medic/view_treatments')->with([
            'flash_message' => 'Recomandarea a fost adăugată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewTreatments()
    {
        $treatments = $this->getTreatments(20);

        return view('medic.viewtreatments', compact('treatments'));
    }

    private function getTreatments($number)
    {

        $treatments_objects = Treatment::all()->take($number)->all();

        $treatments = [];

        foreach ($treatments_objects as $treatment) {

            $treatments[] = $this->treatmentToArray($treatment);

        }

        return $treatments;
    }

    private function treatmentToArray($treatment, $makeReadable = true)
    {
        $item = array_except($treatment->toArray(), ['created_at', 'updated_at']);
        $patient = $treatment->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;
        if ($makeReadable) {
            $item['diagnosis'] = $this->diagnosis[$item['diagnosis']];
            $item['treatment'] = $this->treatments[$item['treatment']];
            $item['appointment'] = ($item['appointment']) ? 'Da' : 'Nu';
        }

        return $item;
    }

    public function treatmentDetails($id)
    {
        $treatment = Treatment::find($id);
        $patient = $treatment->patient;
        $treatment = $this->treatmentToArray($treatment);
        $patient = $this->patientToArray($patient);

        return view('medic.treatmentdetails', compact('treatment', 'patient'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editTreatment($id)
    {
        $treatment = Treatment::find($id);
        $treatment = $this->treatmentToArray($treatment, false);
        $patient = Patient::find($treatment['patient_id']);
        $treatments = $this->treatments;
        $diagnosis = $this->diagnosis;

        return view('medic.edittreatment', compact('treatment', 'patient', 'treatments', 'diagnosis'));
    }

    /**
     * @param $id
     * @param UpdateTreatmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTreatment($id, UpdateTreatmentRequest $request)
    {
        $treatment = Treatment::find($id);

        $requestAll = $request->all();
        $requestAll['date'] = date_create_from_format('d.m.Y H:i', $requestAll['date']);

        if (!(isset($requestAll['appointment'])) || is_null($requestAll['appointment'])) {
            $requestAll['appointment'] = false;
        } else {
            $requestAll['appointment'] = true;
        }

        $treatment->update($requestAll);

        return redirect('medic/view_treatments')->with([
            'flash_message' => 'Recomandarea a fost editată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeTreatment($id)
    {
        $treatment = Treatment::find($id);
        $treatment->delete();

        return redirect('medic/view_treatments')->with([
            'flash_message' => 'Recomandarea a fost ștearsă cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }
    /****************** Treatment related *****************/

    /****************** Survey related *****************/
    public function addSurvey()
    {
        return view('medic.addsurvey');
    }

    private function stringLocaleRoToDate($dateString)
    {
        return date_create_from_format('d.m.Y H:i', $dateString);
    }

    private function dateToStringLocaleEn($date)
    {
        return $date->format("Y-m-d H:i");
    }

    public function createSurvey(CreateSurveyRequest $request)
    {
        $requestAll = $request->all();

        $requestAll['start_date'] = $this->stringLocaleRoToDate($requestAll['start_date']);
        $requestAll['end_date'] = $this->stringLocaleRoToDate($requestAll['end_date']);

        foreach ($requestAll as $requestKey => $requestElem) {
            if (starts_with($requestKey, "question")) {
                if (strlen(trim($requestElem)) == 0) {
                    $requestAll['start_date'] = $this->dateToStringLocaleEn($requestAll['start_date']);
                    $requestAll['end_date'] = $this->dateToStringLocaleEn($requestAll['end_date']);

                    return redirect('medic/add_survey')->with([
                        'flash_message' => 'Toate întrebările trebuie să aibă conţinut!',
                        'flash_message_type' => 'alert-danger'
                    ])->withInput($requestAll);
                }
            }
        }

        if ($requestAll['end_date'] <= $requestAll['start_date']) {
            $requestAll['start_date'] = $this->dateToStringLocaleEn($requestAll['start_date']);
            $requestAll['end_date'] = $this->dateToStringLocaleEn($requestAll['end_date']);
            return redirect('medic/add_survey')->with([
                'flash_message' => 'Data de sfârşit trebuie să fie după cea de început!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }
        $result = Survey::create($requestAll);
        if (is_null($result)) {
            $requestAll['start_date'] = $this->dateToStringLocaleEn($requestAll['start_date']);
            $requestAll['end_date'] = $this->dateToStringLocaleEn($requestAll['end_date']);
            return redirect('medic/add_survey')->with([
                'flash_message' => 'Chestionarul nu a putut fi adăugat!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        $surveyId = $result->id;
        foreach ($requestAll as $requestKey => $requestElem) {
            if (starts_with($requestKey, "question")) {
                $questionId = intval(substr($requestKey, 8, strlen($requestKey)));
                $surveyQuestionRequest = [];
                $surveyQuestionRequest['survey_id'] = $surveyId;
                $surveyQuestionRequest['question_id'] = $questionId;
                $surveyQuestionRequest['question'] = $requestElem;
                $result = SurveyQuestion::create($surveyQuestionRequest);
            }
        }
        return redirect('medic/view_surveys')->with([
            'flash_message' => 'Chestionarul a fost adăugat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewSurveys()
    {
        $surveys = $this->getSurveys(20);

        return view('medic.viewsurveys', compact('surveys'));
    }

    private function getSurveys($number)
    {

        $surveys_objects = Survey::all();

        $surveys = [];

        foreach ($surveys_objects as $survey) {
            $currentDate = new DateTime();
            $startDate = date_create_from_format('d.m.Y H:i', $survey->start_date);
            $endDate = date_create_from_format('d.m.Y H:i', $survey->end_date);
            if (($startDate < $currentDate) && ($endDate > $currentDate)) {
                $surveys[] = $this->surveyToArray($survey);
            }
            else {
                $surveys[] = $this->surveyToArray($survey, true);
            }
        }

        return $surveys;
    }

    private function surveyToArray($survey, $withWarning = false)
    {
        $item = array_except($survey->toArray(), ['created_at', 'updated_at']);
        if ($withWarning) {
            $item['warning'] = true;
        }
        else {
            $item['warning'] = false;
        }

        return $item;
    }

    public function surveyDetails($id)
    {
        $survey = Survey::find($id);
        $survey->questions;
        $survey = $this->surveyToArray($survey);

        return view('medic.surveydetails', compact('survey'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editSurvey($id)
    {
        $survey = Survey::find($id);
        $survey->questions;
        $survey = $this->surveyToArray($survey);

        return view('medic.editsurvey', compact('survey'));
    }

    /**
     * @param $id
     * @param UpdateSurveyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSurvey($id, UpdateSurveyRequest $request)
    {
        $survey = Survey::find($id);

        $requestAll = $request->all();
        $requestAll['start_date'] = $this->stringLocaleRoToDate($requestAll['start_date']);
        $requestAll['end_date'] = $this->stringLocaleRoToDate($requestAll['end_date']);

        foreach ($requestAll as $requestKey => $requestElem) {
            if (starts_with($requestKey, "question")) {
                if (strlen(trim($requestElem)) == 0) {
                    $requestAll['start_date'] = $this->dateToStringLocaleEn($requestAll['start_date']);
                    $requestAll['end_date'] = $this->dateToStringLocaleEn($requestAll['end_date']);

                    return redirect('medic/add_survey')->with([
                        'flash_message' => 'Toate întrebările trebuie să aibă conţinut!',
                        'flash_message_type' => 'alert-danger'
                    ])->withInput($requestAll);
                }
            }
        }

        if ($requestAll['end_date'] <= $requestAll['start_date']) {
            $requestAll['start_date'] = $this->dateToStringLocaleEn($requestAll['start_date']);
            $requestAll['end_date'] = $this->dateToStringLocaleEn($requestAll['end_date']);
            return redirect('medic/edit_survey/' . $id)->with([
                'flash_message' => 'Data de sfârşit trebuie să fie după cea de început!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($requestAll);
        }

        $survey->update($requestAll);

        $surveyId = $survey->id;
        foreach ($requestAll as $requestKey => $requestElem) {
            if (starts_with($requestKey, "question")) {
                $found = false;
                foreach ($survey->questions as $question) {
                    $questionId = intval(substr($requestKey, 8, strlen($requestKey)));
                    if ($question->question_id == $questionId) {
                        $surveyQuestionRequest = [];
                        $surveyQuestionRequest['question'] = $question->question;
                        $question->update($surveyQuestionRequest);
                        $found = true;
                    }
                }
                if (!$found) {
                    $surveyQuestionRequest = [];
                    $surveyQuestionRequest['survey_id'] = $surveyId;
                    $surveyQuestionRequest['question_id'] = $questionId;
                    $surveyQuestionRequest['question'] = $requestElem;
                    $result = SurveyQuestion::create($surveyQuestionRequest);
                }
            }
        }

        return redirect('medic/view_surveys')->with([
            'flash_message' => 'Chestionarul a fost editat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeSurvey($id)
    {
        $survey = Survey::find($id);
        foreach ($survey->questions as $question) {
            $question->delete();
        }
        $survey->delete();

        return redirect('medic/view_surveys')->with([
            'flash_message' => 'Chestionarul a fost șters cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @param $surveyId
     * @return \Illuminate\View\View
     */
    public function viewAnswers($surveyId)
    {
        $survey = Survey::find($surveyId);
        $patients = [];
        foreach ($survey->questions as $question) {
            if ($question->answers && $question->answers->count()) {
                foreach ($question->answers as $answer) {
                    $patient = $answer->patient->toArray();
                    if (!in_array($patient, $patients)) {
                        $patients[] = $patient;
                    }
                }
            }
        }
        return view('medic.viewanswers', compact('patients', 'surveyId'));
    }

    /**
     * @param $patientId
     * @param $surveyId
     * @return \Illuminate\View\View
     */
    public function answerDetails($patientId, $surveyId)
    {
        $survey = Survey::find($surveyId);
        $answers = [];
        foreach ($survey->questions as $question) {
            if ($question->answers && $question->answers->count()) {
                $answerPatient = $question->answers()->where('patient_id', '=', $patientId)->first();
                if ($answerPatient) {
                    $answers[$question->id] = $answerPatient->answer;
                }
            }

        }

        $survey = $survey->toArray();

        return view('medic.answerdetails', compact('survey', 'answers'));
    }

    private function convertDateToRoFormat($date)
    {
        return date_format($date, 'd.m.Y H:i');

    }


}