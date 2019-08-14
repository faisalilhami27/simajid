<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\PengurusLog;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('guest:pengurus', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function staffLogin(LoginRequest $request)
    {
        if (Auth::guard('pengurus')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ],
            $request->get('remember')
        )) {
            $log = PengurusLog::select('last_login_at')
                ->where('id_pengurus', Auth::guard('pengurus')->user()->id_pengurus)
                ->orderBy('last_login_at', 'DESC')
                ->first();

            if (!is_null($log)) {
                Session::put('last_login_at', $log->last_login_at);
            }

            if (!is_null(Auth::guard('pengurus')->user()->id_pengurus)) {
                PengurusLog::create([
                    'id_pengurus' => Auth::guard('pengurus')->user()->id_pengurus,
                    'last_login_ip' => $request->ip(),
                    'last_login_at' => Carbon::now()
                ]);
            }
        }
        return back()->withInput($request->only('username', 'remember'));
    }
}
