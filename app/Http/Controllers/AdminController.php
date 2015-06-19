<?php namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateMedicRequest;
use App\Http\Requests\UpdateMedicRequest;
use App\Medic;
use App\Services\Registrar;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'create']);
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
        $user = $this->createUser($request, $registrar);

        Admin::create(['user_id' => $user->id]);

        return 'Admin user has been successfully created!';
    }

    public function index(Registrar $registrar)
    {
        return view('admin.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function addMedic()
    {
        return view('admin.addmedic');
    }

    /**
     * @param CreateMedicRequest $request
     * @param Registrar $registrar
     * @return \Illuminate\View\View
     */
    public function createMedic(CreateMedicRequest $request, Registrar $registrar)
    {
        $userRequest = array_only($request->all(), ['email', 'password']);
        $userRequest['role'] = 'medic';
        $user = $this->createUser($userRequest, $registrar);

        $medicRequest = array_only($request->all(), ['lastname', 'firstname', 'practice', 'doc_code', 'address']);
        $medicRequest['user_id'] = $user->id;

        Medic::create($medicRequest);

        return redirect('admin/view_medics')->with([
            'flash_message' => 'Medicul a fost adăugat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    private function createUser($request, $registrar)
    {
        return $registrar->create($request);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewMedics()
    {
        $medics = $this->getMedics();

        return view('admin.viewmedics', compact('medics'));
    }

    private function getMedics()
    {

        $medics_objects = Medic::all();

        $medics = [];

        foreach ($medics_objects as $medic) {

            $medics[] = $this->medicToArray($medic);

        }

        return $medics;
    }

    private function medicToArray($medic)
    {
        $item = array_except($medic->toArray(), ['created_at', 'updated_at', 'user_id']);
        $item['email'] = $medic->user->email;

        return $item;
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editMedic($id)
    {
        $medic = Medic::find($id);
        $medic = $this->medicToArray($medic);

        return view('admin.editmedic', compact('medic'));
    }

    public function updateMedic($id, UpdateMedicRequest $request)
    {
        $medic = Medic::find($id);
        $user = $medic->user();

        $medic->update(array_only($request->all(), ['lastname', 'firstname', 'doc_code', 'practice', 'address']));
        $user->update(array_only($request->all(), ['email']));

        return redirect('admin/view_medics')->with([
            'flash_message' => 'Medicul a fost editat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    public function removeMedic($id)
    {
        $medic = Medic::find($id);
        $user = $medic->user();
        try {
            $medic->delete();
            $user->delete();
        } catch (QueryException $e) {
            return redirect('admin/edit_medic/' . $id)->with([
                'flash_message' => 'Nu poate fi şters un medic care încă are pacienţi!',
                'flash_message_type' => 'alert-danger'
            ]);
        }

        return redirect('admin/view_medics')->with([
            'flash_message' => 'Medicul a fost șters cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }
}
