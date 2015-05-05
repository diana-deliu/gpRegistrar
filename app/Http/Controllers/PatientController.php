<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Registrar;
use Illuminate\Http\Request;

class PatientController extends Controller {

    /**
     * @param Registrar $registrar
     */
    public function create(Registrar $registrar)
    {
        $request = [
            'name' => 'patient',
            'email' => 'patient@medimpuls.ro',
            'password' => 'patient'
        ];

        $registrar->create($request);
    }

    /**
     * @param Registrar $registrar
     * @return \Illuminate\View\View
     */
    public function index(Registrar $registrar)
    {
        return view('patient.index');
    }

}
