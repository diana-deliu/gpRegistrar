<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Requests\UpdatePasswordRequest;

use App\Lab;
use App\Patient;
use App\Survey;
use App\SurveyAnswer;
use App\SurveyQuestion;
use App\Treatment;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Configs\HorizontalAxis;
use Khill\Lavacharts\Configs\TextStyle;
use Khill\Lavacharts\Formats\DateFormat;
use Khill\Lavacharts\Lavacharts;

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

    private function BMIFromConsult($consult)
    {
        $heightInM = $consult->height / 100;
        return $consult->weight / ($heightInM * $heightInM);
    }

    public function accountDetails()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $patient->user;
        $patient = $patient->toArray();
        return view('patient.accountdetails', compact('patient'));
    }

    public function editPassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update(['password' => bcrypt($request->input('password'))]);

        return redirect('patient/account_details')->with([
            'flash_message' => 'Parola a fost modificată cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewRegistry()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', '=', $user->id)->firstOrFail();
        $patient->medic;
        $consults = $patient->consults()->orderBy('date')->get();
        $last_consult = $consults->first();
        $patient = $this->patientToArray($patient);
        if ($last_consult) {
            $patient['last_consult'] = $last_consult->toArray();
            $BMIs = \Lava::DataTable();
            /*\Lava::TextStyle([
                'color' => '#000000',
                'fontName' => 'Arial',
                'fontSize' => 50
            ]);*/
            $BMIs->addDateColumn('Data')
                ->addNumberColumn('IMC');
            foreach ($consults as $consult) {
                $BMI = $this->BMIFromConsult($consult);
                $BMIs->addRow([
                    $consult->date,
                    $BMI
                ]);
            }
            $lineChart = \Lava::LineChart('IMC')
                ->dataTable($BMIs)
                ->title('Indice masă corporală')
                ->hAxis(new HorizontalAxis(['format' => 'dd.MM.yyyy']))
                ->colors(['#ff5757'])
                ->titleTextStyle(new TextStyle([
                    'color' => '#000',
                    'fontName' => 'Source Sans Pro',
                    'fontSize' => 15
                ]));

        }
        return view('patient.viewregistry', compact('patient', 'lineChart'));
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
        $item['next_category'] = $item['next_category'] = $this->categories[$item['next_category']];

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
            $currentDate = new DateTime();
            $startDate = date_create_from_format('d.m.Y H:i', $survey->start_date);
            $endDate = date_create_from_format('d.m.Y H:i', $survey->end_date);
            if (($startDate < $currentDate) && ($endDate > $currentDate)) {
                $surveys[] = $this->surveyToArray($survey);
            }
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

    public function addAnswers($id)
    {
        $survey = Survey::find($id);
        $answers = [];
        $user = Auth::user();
        $patientId = Patient::where('user_id', '=', $user->id)->firstOrFail()->id;
        foreach ($survey->questions as $question) {
            $answerPatient = $question->answers()->where('patient_id', '=', $patientId)->first();
            if ($answerPatient) {
                $answers[$question->id] = $answerPatient->answer;
            }
        }
        $survey = $this->surveyToArray($survey);

        return view('patient.addanswers', compact('survey', 'answers'));
    }

    private function upsertSurveyAnswer($questionId, $answer)
    {
        $question = SurveyQuestion::where('id', '=', $questionId)->first();
        $user = Auth::user();
        $patientId = Patient::where('user_id', '=', $user->id)->firstOrFail()->id;

        $request = [
            'patient_id' => $patientId,
            'question_id' => $questionId,
            'answer' => $answer
        ];
        if ($question->answers && $question->answers->count()) {
            $answerPatient = $question->answers()->where('patient_id', '=', $patientId)->first();
            if ($answerPatient) {
                $result = $answerPatient->update(['answer' => $answer]);
                if (!$result) {
                    return false;
                }
            } else {
                $result = SurveyAnswer::create($request);
                if (!$result) {
                    return false;
                }
            }
        } else {
            $result = SurveyAnswer::create($request);
            if (!$result) {
                return false;
            }
        }

        return true;
    }

    public function createAnswers(Request $request, $surveyId)
    {
        $requestAll = $request->all();
        foreach ($requestAll as $key => $elem) {
            if (starts_with($key, 'answer')) {
                if (!strlen($elem)) {
                    return redirect('patient/add_answers/' . $surveyId)->with([
                        'flash_message' => 'Toate întrebările sunt obligatorii!',
                        'flash_message_type' => 'alert-danger'
                    ])->withInput($requestAll);
                }
            }
        }
        foreach ($requestAll as $key => $elem) {
            if (starts_with($key, 'answer')) {
                $questionId = intval(substr($key, 6, strlen($key)));
                if (!$this->upsertSurveyAnswer($questionId, $elem)) {
                    return redirect('patient/add_answers/' . $surveyId)->with([
                        'flash_message' => 'Chestionarul nu a putut fi completat!',
                        'flash_message_type' => 'alert-danger'
                    ])->withInput($requestAll);
                }
            }
        }

        return redirect('patient/view_surveys')->with([
            'flash_message' => 'Chestionarul a fost completat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);

    }

}
