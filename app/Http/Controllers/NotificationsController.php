<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lab;
use App\Patient;
use App\Survey;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller {

    public function __construct()
    {
        $this->middleware('patient', ['only' => 'patientGet']);
        $this->middleware('medic', ['only' => 'medicGet']);
    }

    public static function patientGet()
    {
        $notifications = [];
        $patientId = Patient::where('user_id', '=', Auth::user()->id)->firstOrFail()->id;

        $beginOfDayTimestamp = strtotime("midnight");
        $endOfWeekTimestamp   = strtotime("+1 week", $beginOfDayTimestamp) - 1;
        $bod = new DateTime(date('c', $beginOfDayTimestamp));
        $eow = new DateTime(date('c', $endOfWeekTimestamp));

        $consults = Consult::where('next_date', '>=', $bod)->where('next_date', '<=', $eow)->where('patient_id', '=', $patientId)->get();
        foreach($consults as $consult) {
            $notifications[] = [
                'type' => 'consult',
                'text' => 'Consultaţie în data de '.$consult->next_date
            ];
        }
        $labs = Lab::where('next_date', '>=', $bod)->where('next_date', '<=', $eow)->where('patient_id', '=', $patientId)->get();
        foreach($labs as $lab) {
            $notifications[] = [
                'type' => 'lab',
                'text' => 'Analize în data de '.$lab->next_date
            ];
        }
        $vaccines = Vaccine::where('next_date', '>=', $bod)->where('next_date', '<=', $eow)->where('patient_id', '=', $patientId)->get();
        foreach($vaccines as $vaccine) {
            $notifications[] = [
                'type' => 'vaccine',
                'text' => 'Vaccinare în data de '.$vaccine->next_date
            ];
        }
        $surveys = Survey::where('end_date', '>=', $bod)->where('end_date', '<=', $eow)->get();
        foreach($surveys as $survey) {
            $notifications[] = [
                'type' => 'survey',
                'text' => 'Chestionarul '.$survey->title.' expiră!'
            ];
        }

        return $notifications;

    }

    public static function medicGet()
    {
        $notifications = [];

        $beginOfDayTimestamp = strtotime("midnight");
        $endOfDayTimestamp   = strtotime("tomorrow", $beginOfDayTimestamp) - 1;
        $bod = new DateTime(date('c', $beginOfDayTimestamp));
        $eod = new DateTime(date('c', $endOfDayTimestamp));

        $consults = Consult::where('next_date', '>=', $bod)->where('next_date', '<=', $eod)->get();
        foreach($consults as $consult) {
            $notifications[] = [
                'type' => 'consult',
                'text' => $consult->patient->firstname . ' ' .$consult->patient->lastname
            ];
        }
        $labs = Lab::where('next_date', '>=', $bod)->where('next_date', '<=', $eod)->get();
        foreach($labs as $lab) {
            $notifications[] = [
                'type' => 'lab',
                'text' => $lab->patient->firstname . ' ' .$lab->patient->lastname
            ];
        }
        $vaccines = Vaccine::where('next_date', '>=', $bod)->where('next_date', '<=', $eod)->get();
        foreach($vaccines as $vaccine) {
            $notifications[] = [
                'type' => 'vaccine',
                'text' => $vaccine->patient->firstname . ' ' .$vaccine->patient->lastname
            ];
        }

        return $notifications;
    }

}
