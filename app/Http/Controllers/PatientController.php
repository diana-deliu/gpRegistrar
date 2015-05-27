<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Registrar;
use Illuminate\Http\Request;

class PatientController extends Controller {

    public function __construct()
    {
        $this->middleware('patient');
    }
}
