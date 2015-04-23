<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Registrar;
use Illuminate\Http\Request;

class AdminController extends Controller {

    /**
     * @param Registrar $registrar
     */
    public function create(Registrar $registrar)
    {
        $request = [
            'name' => 'admin',
            'email' => 'admin@medimpuls.ro',
            'password' => 'admin'
        ];

        $registrar->create($request);
    }

    public function index(Registrar $registrar)
    {
        return view('admin.index');
    }

}
