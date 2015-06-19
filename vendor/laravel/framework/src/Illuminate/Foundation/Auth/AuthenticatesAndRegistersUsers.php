<?php namespace Illuminate\Foundation\Auth;

use App\Http\Requests\RegisterPatientRequest;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

trait AuthenticatesAndRegistersUsers
{

    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var \Illuminate\Contracts\Auth\Registrar
     */
    protected $registrar;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterPatientRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterPatientRequest $request)
    {

        $patient = Patient::where('cnp', '=', $request->input('cnp'))->first();
        if (!$patient) {
            return redirect('auth/register')->with([
                'flash_message' => 'Nu sunteţi înregistrat în baza de date! Contactaţi-vă medicul!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($request->all());
        }
        $user = $patient->user;
        if ($user->email !== $request->input('email')) {
            return redirect('auth/register')->with([
                'flash_message' => 'Adresa de e-mail nu corespunde cu CNP-ul înregistrat!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($request->all());
        }
        if (strlen($user->password)) {
            return redirect('auth/login')->with([
                'flash_message' => 'Sunteţi deja înregistrat! Folosiţi formarul de <a href="' . url('password/email') . '">recuperare parolă</a> dacă aţi uitat-o!',
                'flash_message_type' => 'alert-danger'
            ])->withInput($request->all());
        }
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
        $this->auth->login($user);

        return redirect('patient/view_registry')->with([
            'flash_message' => 'Aţi fost înregistrat cu succes!',
            'flash_message_type' => 'alert-success'
        ]);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

}