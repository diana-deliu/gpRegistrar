<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lab;
use App\Patient;
use App\Services\Registrar;
use App\Survey;
use App\Treatment;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
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

    private $intervals = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        '11' => '11',
        '12' => '12'
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
        $this->middleware('patient');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewRegistry()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $patient->medic;
        $last_consult = $patient->consults()->orderBy('date')->first();
        $patient = $this->patientToArray($patient);
        $patient['last_consult'] = $last_consult->toArray();

        return view('patient.viewregistry', compact('patient'));
    }

    private function consultToArray($consult)
    {
        $item = array_except($consult->toArray(), ['created_at', 'updated_at']);
        $patient = $consult->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;

        return $item;
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

    /**
     * @return \Illuminate\View\View
     */
    public function viewConsults()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $consult_objects = $patient->consults;
        $consults = [];
        foreach ($consult_objects as $consult) {
            $consults[] = $this->consultToArray($consult);
        }

        return view('patient.viewconsults', compact('consults'));
    }

    public function consultDetails($id)
    {
        $consult = Consult::find($id);
        $patient = $consult->patient;
        $consult = $this->consultToArray($consult);
        $patient = $this->patientToArray($patient);

        return view('patient.consultdetails', compact('consult', 'patient'));
    }

    public function viewLabs()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $lab_objects = $patient->labs;
        $labs = [];
        foreach ($lab_objects as $lab) {
            $labs[] = $this->labToArray($lab);
        }

        return view('patient.viewlabs', compact('labs'));
    }

    public function labDetails($id)
    {
        $lab = Lab::find($id);
        $patient = $lab->patient;
        $lab = $this->labToArray($lab);
        $patient = $this->patientToArray($patient);

        return view('patient.labdetails', compact('lab', 'patient'));
    }

    private function labToArray($lab)
    {
        $item = array_except($lab->toArray(), ['created_at', 'updated_at']);
        $patient = $lab->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;

        return $item;
    }

    public function viewVaccines()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $vaccine_objects = $patient->vaccines;
        $vaccines = [];
        foreach ($vaccine_objects as $vaccine) {
            $vaccines[] = $this->vaccineToArray($vaccine);
        }

        return view('patient.viewvaccines', compact('vaccines'));
    }

    private function vaccineToArray($vaccine)
    {
        $item = array_except($vaccine->toArray(), ['created_at', 'updated_at']);
        $patient = $vaccine->patient;
        $item['lastname'] = $patient->lastname;
        $item['firstname'] = $patient->firstname;
        $item['category'] = $item['category'] = $this->categories[$item['category']];
        $item['interval'] = $this->intervals[$item['interval']];
        if ($item['interval'] > 1) {
            $item['interval'] .= " luni";
        } else {
            $item['interval'] .= " lună";
        }

        $item['notification'] = ($item['notification']) ? 'Da' : 'Nu';
        $item['appointment'] = ($item['appointment']) ? 'Da' : 'Nu';

        return $item;
    }

    public function vaccineDetails($id)
    {
        $vaccine = Vaccine::find($id);
        $patient = $vaccine->patient;

        $vaccine = $this->vaccineToArray($vaccine);
        $patient = $this->patientToArray($patient);

        return view('patient.vaccinedetails', compact('vaccine', 'patient'));
    }

    public function viewTreatments()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $treatment_objects = $patient->treatments;
        $treatments = [];
        foreach ($treatment_objects as $treatment) {
            $treatments[] = $this->treatmentToArray($treatment);
        }

        if (!(isset($requestAll['appointment'])) || is_null($requestAll['appointment'])) {
            $requestAll['appointment'] = false;
        } else {
            $requestAll['appointment'] = true;
        }

        return view('patient.viewtreatments', compact('treatments'));
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
            $item['interval'] = $this->intervals[$item['interval']];
            if ($item['interval'] > 1) {
                $item['interval'] .= " luni";
            } else {
                $item['interval'] .= " lună";
            }

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

        return view('patient.treatmentdetails', compact('treatment', 'patient'));
    }

    private function getSurveys()
    {

        $surveys_objects = Survey::all();

        $surveys = [];

        foreach ($surveys_objects as $survey) {
            $survey->questions;
            $surveys[] = $this->surveyToArray($survey);

        }

        return $surveys;
    }

    public function viewSurveys()
    {
        $surveys = $this->getSurveys();

        return view('patient.viewsurveys', compact('surveys'));
    }

    private function surveyToArray($survey)
    {
        $item = array_except($survey->toArray(), ['created_at', 'updated_at']);

        return $item;
    }

    public function surveyDetails($id)
    {
        $survey = Survey::find($id);
        $survey->questions;
        $survey = $this->surveyToArray($survey);

        return view('patient.surveydetails', compact('survey'));
    }

}
