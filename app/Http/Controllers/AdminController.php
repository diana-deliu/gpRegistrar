<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Registrar;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('medic', ['except' => 'create']);
    }

    /**
     * @param Registrar $registrar
     * @return string
     */
    public function create(Registrar $registrar)
    {
        $user = User::whereRole('admin')->first();
        if (!(is_null($user))) {
            return 'Admin is already created!';
        }

        $request = [
            'email' => 'admin@gpregistrar.ro',
            'password' => 'admin',
            'role' => 'admin'
        ];
        $registrar->create($request);

        return 'Admin user has been successfully created!';
    }

    public function index(Registrar $registrar)
    {
        return view('admin.index');
    }

}
