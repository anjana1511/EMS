<?php
namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;
use App\Department;
use DB;
use App\Role;
use Auth;
use User;

class ProjectController extends Controller
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
        //
        $uid=Auth::user()->id;
        $id=Auth::user();
        $role =$id->hasRole('admin');
  
          $deptdata=Department::whereNull('deleted_at')->get();
          return view('project',compact('deptdata','role'));
    }



    public function getProject($id) 
    {        
        // dd($id);
        $projectdata=Project::whereNull('deleted_at')->where("dept_id",$id)->pluck("pname","p_id");
        return json_encode($projectdata);
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
        //
        $inputArr=$request->all();
        // dd($inputArr);
        $hash_id= $hash_id=md5(uniqid(rand(), true));

        //Validate
          $request->validate([
            'pname' => 'required|min:2|alpha|unique:projects,pname',
            'dept_name' => 'required',
            'pdetails' => 'required'
          
        ]);
        
        $task = Project::create(['dept_id' => $inputArr['dept_name'],'hash_id'=>$hash_id,'pname' =>$inputArr['pname'],'details' =>$inputArr['pdetails']]);
        return redirect()->back()->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $projectData['data'] = DB::table('projects')
        ->join('department', 'department.dept_id', '=', 'projects.dept_id')
        ->select('projects.p_id','projects.pname','projects.hash_id','department.dept_name','projects.created_at','projects.updated_at','projects.deleted_at')
        ->whereNull('projects.deleted_at')
        ->get();
        
        // dd(response()->json($projectData));
        return response()->json($projectData);
    }

    public function getdeptdata()
    {
        $deptdata=Department::whereNull('deleted_at')->get();

        return response()->json($deptdata);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
         
        //Validate
  
        $editdata=Project::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
        $dept_id=$editdata->dept_id;
        $deptdata=Department::where('dept_id','=',$dept_id)->whereNull('deleted_at')->get();

return response()->json(['projectdata'=>$editdata,'deptdata'=>$deptdata]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $inputArr=$request->all();
        $edit_id=$inputArr['edit_id'];
        $dept_id=$inputArr['dept_id'];
        $pname=$inputArr['epname'];
        $details=$inputArr['epdetails'];

                //Validate
                $request->validate([
                    'edit_id' => 'required',
                    'epname' => 'required|min:2|alpha',
                    'dept_id' => 'required|min:1'
                  
                ]);
        

        $data=Project::where('hash_id','=',$edit_id)->update(['dept_id'=>$dept_id,'pname'=>$pname,'details'=>$details]);

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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $inputArr=$request->all();
        // dd($inputArr['id']);
        $model = Project::where('hash_id','=',$inputArr['id']);
       
        $model->delete();

        return response()->json($inputArr['id']);

    }


}
