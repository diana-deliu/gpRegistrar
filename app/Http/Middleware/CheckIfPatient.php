<?php namespace App\Http\Middleware;

use Closure;

class CheckIfPatient {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest('auth/login');
            }
        }
        $user = $this->auth->user();
        if ($user->role != 'patient') {
            return redirect()->guest('auth/login');
        }

        return $next($request);
    }

}
