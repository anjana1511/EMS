<?php
namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use DataTables;
class StateController extends Controller
{
    //

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $states = State::whereNull('deleted_at')->paginate(2);

        return view('state', compact('states'));
    }

    public function getdata()
    {
      
        $stateData['data']=State::whereNull('deleted_at')->get();

        return response()->json($stateData);
    }


    public function store(Request $request)
    {
        $inputArr=$request->all();
        $hash_id= $hash_id=md5(uniqid(rand(), true));

        //Validate
          $request->validate([
            'name' => 'required|min:2|alpha|unique:states,state_name',
          
        ]);
        
        $task = State::create(['state_name' => $inputArr['name'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');
       
    }

    public function getdatabyid(Request $request)
    {
        $inputArr=$request->all();
        $stateeditdata['data']=State::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
      return response()->json($stateeditdata);
    }

    public function edit(Request $request)
    {
        $inputArr=$request->all();

        $edit_id=$inputArr['edit_id'];
        $name=$inputArr['ename'];
                //Validate
                $request->validate([
                    'ename' => 'required|min:2|alpha',
                  
                ]);

        $data=State::where('hash_id','=',$edit_id)->update(['state_name'=>$name]);

        if($data)
        {
            return redirect()->back()->with('message', 'Record Updated!');
        }
        else
        {
            print_r("error");
        }
    }

    public function deletedata(Request $request)
    {
        $inputArr=$request->all();

        $model = State::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);

    }
}
