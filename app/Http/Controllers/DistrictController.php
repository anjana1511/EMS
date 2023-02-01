<?php
namespace App\Http\Controllers;
use App\District;
use Illuminate\Http\Request;
use App\State;
use DB;
use App\Role;
use Auth;
use User;

class DistrictController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $uid=Auth::user()->id;
      $id=Auth::user();
      $role =$id->hasRole('admin');

        $statedata=State::whereNull('deleted_at')->get();

        return view('district',compact('statedata','role'));
    }

    public function getDistrict($id) 
    {        
        $distdata=District::whereNull('deleted_at')->where("state_id",$id)->pluck("district_name","dist_id");
        return json_encode($distdata);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputArr=$request->all();
        $hash_id= $hash_id=md5(uniqid(rand(), true));

        //Validate
          $request->validate([
            'dist_name' => 'required|min:2|alpha|unique:districts,district_name',
            'state_name' => 'required'
          
        ]);
        
        $task = District::create(['district_name'=>$inputArr['dist_name'],'state_id' => $inputArr['state_name'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');
       
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

         $districtData['data'] = DB::table('districts')
        ->join('states', 'states.state_id', '=', 'districts.state_id')
        ->select('districts.dist_id','districts.district_name','districts.hash_id','states.state_name','districts.created_at','districts.updated_at','districts.deleted_at')
        ->whereNull('districts.deleted_at')
        ->get();

        return response()->json($districtData);
    }
    
    public function getstatedata()
    {
        $statedata=State::whereNull('deleted_at')->get();

        return response()->json($statedata);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $inputArr=$request->all();

                //Validate
          
        $editdata=District::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
        $state_id=$editdata->state_id;
        $statedata=State::where('state_id','=',$state_id)->whereNull('deleted_at')->get();
 
        return response()->json(['distdata'=>$editdata,'statedata'=>$statedata]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputArr=$request->all();
        $edit_id=$inputArr['edit_id'];
        $state_id=$inputArr['state_id'];
        $dist_name=$inputArr['edist_name'];

                //Validate
                $request->validate([
                    'edit_id' => 'required',
                    'edist_name' => 'required|min:2|alpha',
                    'state_id' => 'required|min:1'
                  
                ]);
        

        $data=District::where('hash_id','=',$edit_id)->update(['state_id'=>$state_id,'district_name'=>$dist_name]);

        if($data)
        {
            return redirect()->back()->with('message', 'Record Updated!');
        }
        else
        {
            print_r("error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inputArr=$request->all();
        // dd($inputArr['id']);
        $model = District::where('hash_id','=',$inputArr['id']);
       
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
