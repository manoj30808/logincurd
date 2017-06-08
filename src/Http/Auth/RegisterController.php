<?php namespace MspPack\DDSAdmin\Http\Auth;

use Mail;
use DB;
use MspPack\DDSAdmin\User;
use Illuminate\Http\Request;
use MspPack\DDSAdmin\Mail\EmailVerification;
use MspPack\DDSAdmin\Http\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Form;
use View;
use MspPack\DDSAdmin\Setting;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $setting = Setting::first();
        View::share('login_with',(isset($setting->login_with) && !empty($setting->login_with))?$setting->login_with:'email' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'first_name' => 'required|string|alpha_space|max:255',
            'last_name' => 'required|string|alpha_space|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            /*'g-recaptcha-response' => 'required|captcha',*/
        ];
        if (isset($data['login_with']) && !empty($data['login_with']) ) {
            $rules['username'] = 'required|string|max:255|unique:users';
        }elseif (isset($data['username']) && !empty($data['username']) ) {
            $rules['username'] = 'required|string|max:255|unique:users';
            unset($rules['email']);
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $verified = (isset($data['username']) && !empty($data['username']))?'1':'0';
        $user =  User::create([
            'name' => $data['first_name'].' '.$data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => isset($data['email'])?$data['email']:'',
            'username' => isset($data['username'])?$data['username']:'',
            'password' => bcrypt($data['password']),
            'verified' => $verified,
            'email_token' => str_random(10),
        ]);
        $user->attachRole('2');

        return $user;
    }

    /**
    *  Over-ridden the register method from the "RegistersUsers" trait
    *  Remember to take care while upgrading laravel
    */
    public function register(Request $request)
    {
        // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }
        // Using database transactions is useful here because stuff happening is actually a transaction
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $user = $this->create($request->all());
            
            $msg = 'Register Successfully Please login.';
            if (isset($user->email) && !empty($user->email) ) {
                $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
                Mail::to($user->email)->send($email);
                
                $msg = 'Register Successfully Please check your mail for varification.';
            }
            
            DB::commit();
            return back()->with('success',$msg);
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return back();
        }
    }

    // Get the user who has the same token and change his/her status to verified i.e. 1
    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        $user = User::where('email_token',$token)->first();
        if(!empty($user)){
            User::where('email_token',$token)->firstOrFail()->verified();
            return redirect('admin/login')->with('success','You Are Successfully verified please login');
        }
        return redirect('admin/login')->with('error','You Are Already verified or token not found in our records.');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }
}
