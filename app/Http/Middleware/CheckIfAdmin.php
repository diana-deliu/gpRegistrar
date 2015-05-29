<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckIfAdmin {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

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
    if ($user->role != 'admin') {
        return redirect('/')->with([
            'flash_message' => 'Nu aveți drepturi să accesați această pagină!',
            'flash_message_type' => 'alert-danger'
        ]);
    }

    return $next($request);
}

}
