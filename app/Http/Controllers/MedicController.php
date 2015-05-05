<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Registrar;
use Illuminate\Http\Request;

class MedicController extends Controller {

    public function create(Registrar $registrar)
    {
        $request = [
            'name' => 'medic',
            'email' => 'medic@medimpuls.ro',
            'password' => 'medic'
        ];

        $registrar->create($request);
    }

    public function index(Registrar $registrar)
    {
        return view('medic.index');
    }

}
