<?php namespace App\Http\Controllers;

use App\Consult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lab;
use App\Vaccine;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller {

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('patient', ['only' => 'patientGet']);
        $this->middleware('medic', ['only' => 'medicGet']);

    }

    public function patientGet() {
    }

    public function medicGet() {
        $consults = Consult::where('next_date', '>=', new DateTime())->get();
        $labs = Lab::where('next_date', '>=', new DateTime())->get();
        $vaccines = Vaccine::where('next_date', '>=', new DateTime())->get();
    }

}
