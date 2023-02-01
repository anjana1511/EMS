<?php
namespace App\Http\Controllers;
use App\Empleave as Leave;
use App\Leavetype as Leavetype;
use App\Employee as emp;
use Illuminate\Http\Request;
use DB;
use Auth;
class EmpleaveController extends Controller
{
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
        //listing all Leaves

        $id=Auth::user();
        $role =$id->hasRole('admin');
    
        if($id->hasRole('admin'))
        {
            // dd('admin');
         $empdata = DB::table('empleave')
        ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
        ->join('employee','empleave.emp_id','=','employee.emp_id')
        ->whereNull('empleave.deleted_at')
        ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
        ->get();
        }
        else
        {

            $email=Auth::user()->email;
            // dd($email);
            $empdata = DB::table('empleave')
            ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
            ->join('employee','empleave.emp_id','=','employee.emp_id')
            ->whereNull('empleave.deleted_at')
            ->where('employee.email','=',$email)
            ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
            ->get();
            // dd($data);
        }
        // dd($empdata);
        return view('leave_list',compact(['empdata']));
        
    }
//listing Pending Leaves
    public function Pending_leaves()
    {
        
        $id=Auth::user();
        $role =$id->hasRole('admin');
        if($id->hasRole('admin'))
        {
         $empdata = DB::table('empleave')
        ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
        ->join('employee','empleave.emp_id','=','employee.emp_id')
        ->where('empleave.leave_status','=','0')
        ->whereNull('empleave.deleted_at')
        ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
        ->get();
        }
        else
        {
            $empdata = DB::table('empleave')
            ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
            ->join('employee','empleave.emp_id','=','employee.emp_id')
            ->where('empleave.leave_status','=','0')
            ->where('employee.email','=',Auth::user()->email)
            ->whereNull('empleave.deleted_at')
            ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
            ->get();
        }
        return view('leavePending_list',compact('empdata'));
    }

//listing Approved Leaves

    public function Approved_leaves()
    {
        
        $id=Auth::user();
        $role =$id->hasRole('admin');
        if($id->hasRole('admin'))
        {
         $empdata = DB::table('empleave')
        ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
        ->join('employee','empleave.emp_id','=','employee.emp_id')
        ->where('empleave.leave_status','=','1')
        ->whereNull('empleave.deleted_at')
        ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
        ->get();
        }
        else
        {
            $empdata = DB::table('empleave')
            ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
            ->join('employee','empleave.emp_id','=','employee.emp_id')
            ->where('empleave.leave_status','=','1')
            ->where('employee.email','=',Auth::user()->email)
            ->whereNull('empleave.deleted_at')
            ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
            ->get();
        }
        return view('leaveApproved_list',compact('empdata'));
    }

  public function getdatabyid($id)
  {
     //emp Leaves By Id

     
         $data = DB::table('empleave')
        ->join('leavetype', 'leavetype.l_id', '=', 'empleave.l_id')
        ->join('employee','empleave.emp_id','=','employee.emp_id')
        ->where('empleave.hash_id','=',$id)
        ->whereNull('empleave.deleted_at')
        ->select('empleave.id','empleave.emp_id','empleave.hash_id','empleave.l_id','empleave.leave_fromdate','empleave.leave_todate','empleave.leave_description','empleave.leave_status','empleave.admin_remark','employee.firstname','employee.middlename','employee.email','employee.Mono','leavetype.leave_type','empleave.created_at','empleave.updated_at','empleave.deleted_at')
        ->first();

          return view('leave_details',compact(['data']));

  }

  //change leave status

  public function change_status(Request $request)
  {
   $inputArr=$request->all();
   $data=leave::whereNull('deleted_at')->where('hash_id','=',$inputArr['edit_id'])->first();

   return response()->json($data);
  }

  public function update_status(Request $request)
  {
           $inputArr=$request->all();
// dd($inputArr);
        $edit_id=$inputArr['id'];
        $remark=$inputArr['remark'];
        $status=$inputArr['leave_status'];
                //Validate
                $val=$request->validate([
                    'remark' => 'required',
                  
                ]);
                

    $data=Leave::where('hash_id','=',$edit_id)->update(['leave_status'=>$status,'admin_remark'=>$remark]);

        if($data)
        {
            return redirect()->back()->with('message', 'Record Updated!');
        }
        else
        {
            return redirect()->back()->withErrors('message','Something was Wrong');
        }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id=Auth::user();
        // dd($id);
        $role =$id->hasRole('admin');
        Auth::user()->email;
        
        $empdata=emp::where('email','=',Auth::user()->email)->pluck("emp_id")->toArray();
        $emp_id=implode(" ",$empdata);
        // dd($emp_id);
                        
        $leave_type=Leavetype::whereNull('deleted_at')->get();


        return view('leave_apply',compact(['leave_type','emp_id']));

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
        $emp_id=$inputArr['emp_id'];
        $hash_id=md5(uniqid(rand(), true));
        $l_id=$inputArr['l_id'];
        $fdate=$inputArr['fdate'];
        $tdate=$inputArr['tdate'];
        $des=$inputArr['des'];
        $leave_status="0";
        $admin_remark="Wait for Admin Response";
// dd($emp_id);
        $task = Leave::create(['emp_id' => $emp_id,'hash_id'=>$hash_id,'l_id' => $l_id,'leave_fromdate'=>$fdate,'leave_todate'=>$tdate,'leave_description'=>$des,'leave_status'=>$leave_status,'admin_remark'=>$admin_remark]);
        return redirect()->back()->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleave  $empleave
     * @return \Illuminate\Http\Response
     */
    public function show(Empleave $empleave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleave  $empleave
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleave $empleave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleave  $empleave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleave $empleave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleave  $empleave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $inputArr=$request->all();

        $model = Leave::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
