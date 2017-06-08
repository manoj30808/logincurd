<?php namespace MspPack\DDSAdmin\Http;

use Illuminate\Http\Request;
use MspPack\DDSAdmin\Repositories\UserRepo;
use MspPack\DDSAdmin\Repositories\SettingRepo;
use Illuminate\Support\Facades\Validator;
use View;

class SettingController extends Controller
{
	private $view_path;
    protected $SettingRepo;
    private $ctrl_url;

    public function __construct(SettingRepo $SettingRepo)
    {
    	$this->middleware('auth');
        $this->SettingRepo = $SettingRepo;
        $this->ctrl_url = '/admin/setting';

        $this->view_path = 'admin.setting';
        View::share(['ctrl_url'=>$this->ctrl_url,'view_path'=>$this->view_path,'module_name'=> 'Setting','title'=>'Setting']);
    }

    public function index()
    {
        $param = ['single'=>true];
        
        $item = (array) $this->SettingRepo->getBy($param);
        $compact = compact('item');
        return view($this->view_path.'.'.(!empty($item)?'update':'create'),$compact);
    }

    public function store(Request $request)
    {
        $inputs = $request->except('_token','_method');
        $data   = array_except($inputs,array('save','save_exit'));

        if($this->SettingRepo->create($data)){
            return redirect($this->ctrl_url)
            ->with('success', 'Record created sucessfully');
        }

        return redirect('admin/setting')->with('error', 'Can not be created');
    }

    public function update(Request $request,$id)
    {
    	$inputs = $request->except('_token','_method');
        $data   = array_except($inputs,array('save','save_exit'));

        if($this->SettingRepo->update($data,$id)){
    		return redirect($this->ctrl_url)
            ->with('success', 'Record updated sucessfully');
        }

        return redirect($this->ctrl_url)->with('error', 'Can not be created');
    }
}
