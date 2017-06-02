<?php namespace MspPack\LaravelApp\Http\Auth;

use \App\Http\Controllers\Controller;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Socialite;
use \Illuminate\Support\Facades\Auth;
use \App\User as User;
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
    protected $redirectTo = '/home';

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
}
