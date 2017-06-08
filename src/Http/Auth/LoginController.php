<?php namespace MspPack\DDSAdmin\Http\Auth;

use MspPack\DDSAdmin\Http\Controller;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Socialite;
use \Illuminate\Support\Facades\Auth;
use MspPack\DDSAdmin\User as User;
use \Illuminate\Http\Request;
use \DirkGroenen\Pinterest\Pinterest;
use DB;


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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $pinterest;
    public function __construct()
    {
        $this->pinterest = new Pinterest(config('services.pinterest.client_id'), config('services.pinterest.client_secret'));
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request,$provider)
    {
        if($provider=='facebook'){
            \Session::flush();
            
            $state = $request->get('state');
            $request->session()->put('state',$state);
            session()->regenerate();
        }
        
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
    
    /*PINTEREST LOGIN METHOD*/
    public function redirectToCustomProvider($provider='')
    {
        $loginurl = $this->pinterest->auth->getLoginUrl(config('services.pinterest.redirect'), array('read_public'));
        return redirect($loginurl);
    }

    public function handleCustomProviderCallback(Request $request,$provider) {
        if($request->has('code')){
            $token = $this->pinterest->auth->getOAuthToken($request->get('code'));
            $this->pinterest->auth->setOAuthToken($token->access_token);
        }
        $user = $this->pinterest->users->me();
        
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
    

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $user = User::create([
            'name'     => (isset($user->name)?$user->name:$user->first_name.' '.$user->last_name),
            'email'    => isset($user->email)?$user->email:'',
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
        
        return $user;
    }
    public function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
        ];
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->redirectTo);
    }
}
