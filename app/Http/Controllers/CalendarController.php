<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lab;
use App\Patient;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('patient', ['only' => 'patientGet']);
        $this->middleware('medic', ['only' => 'medicGet']);

    }

    public function patientGet()
    {
        $patientId = Patient::where('user_id', '=', Auth::user()->id)->firstOrFail()->id;
        $consults = Consult::where('next_date', '>=', new DateTime())->where('patient_id', '=', $patientId)->get();
        $labs = Lab::where('next_date', '>=', new DateTime())->where('patient_id', '=', $patientId)->get();
        $vaccines = Vaccine::where('next_date', '>=', new DateTime())->where('patient_id', '=', $patientId)->get();

        $result = [
            'consults' => $consults->toArray(),
            'labs' => $labs->toArray(),
            'vaccines' => $vaccines->toArray()
        ];

        return $result;
    }

    public function medicGet()
    {
        $consults = Consult::where('next_date', '>=', new DateTime())->get();
        foreach($consults as $consult) {
            $consult->patient;
        }
        $labs = Lab::where('next_date', '>=', new DateTime())->get();
        foreach($labs as $lab) {
            $lab->patient;
        }
        $vaccines = Vaccine::where('next_date', '>=', new DateTime())->get();
        foreach($vaccines as $vaccine) {
            $vaccine->patient;
        }

        $result = [
            'consults' => $consults->toArray(),
            'labs' => $labs->toArray(),
            'vaccines' => $vaccines->toArray()
        ];

        return $result;
    }

}
