<?php

namespace App\Http\Controllers;

use App\Employee;
use App\State;
use App\District;
use App\Taluka;
use App\Village;
use App\Salary;
use App\Department;
use App\Division;
use App\User;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $statedata=State::whereNull('deleted_at')->get();
        $empdata=Employee::whereNull('deleted_at')->get();
        $salary=Salary::whereNull('deleted_at')->get();

        return view('employee_list',compact('statedata','empdata','salary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $statedata=State::whereNull('deleted_at')->get();
        $salary=Salary::whereNull('deleted_at')->get();
        $dept=Department::whereNull('deleted_at')->get();
        $division=Division::whereNull('deleted_at')->get();

          return view('add_employee',compact(['statedata','salary','dept','division']));
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
// dd($inputArr)
        $hash_id= $hash_id=md5(uniqid(rand(), true));
        $request->validate([
                    'firstname' => 'required|min:2',
                    'middlename' => 'required|min:1',
                    'email'=>'required',
                    'Mono'=>'required',
                    'age' => 'required|min:1',
                    'village_id' => 'required',
                    'taluka_id' => 'required',
                    'dist_id' => 'required',
                    'state_id' => 'required',
                    'join_date' => 'required',
                    'dob' => 'required',
                ]);
          $dob = Carbon::parse($inputArr['dob'])->format('Y-m-d');
          $join_date = Carbon::parse($inputArr['join_date'])->format('Y-m-d');

        $task =[
            'firstname'=>$inputArr['firstname'],
            'middlename'=>$inputArr['middlename'],
             'email'=>$inputArr['email'],
            'Mono'=>$inputArr['Mono'],
            'salary'=>$inputArr['Salary'],
            'dept'=>$inputArr['dept'],
            'dob'=>$dob,
            'join_date'=>$join_date,
            'age'=>$inputArr['age'],
            'divi_id'=>$inputArr['divi'],
            'dept'=>$inputArr['dept'],
            'village_id'=>$inputArr['village_id'],
            'taluka_id'=>$inputArr['taluka_id'],
            'dist_id'=>$inputArr['dist_id'],
            'state_id' => $inputArr['state_id'],
            'hash_id'=>$hash_id,
            
        ];
        // Hash::make($data['password'])
        User::create([
            'name' =>$inputArr['firstname'],
            'email' => $inputArr['email'],
            'password' =>Hash::make($inputArr['Mono']),
        ]);
        
        $emp=Employee::create($task);
// dd($emp);
        return redirect(route('emp'))->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      // dd($id);
        $data=Employee::where('hash_id','=',$id)->whereNull('deleted_at')->first();
        $state_id=$data['state_id'];
        $statedata=State::whereNull('deleted_at')->where('state_id','=',$state_id)->first();
        
        $distdata=District::whereNull('deleted_at')->where('dist_id','=',$data['dist_id'])->first();
        $talukadata=Taluka::whereNull('deleted_at')->where('taluka_id','=',$data['taluka_id'])->first();
        $citydata=Village::whereNull('deleted_at')->where('village_id','=',$data['village_id'])->first();
        $salary=Salary::whereNull('deleted_at')->where('id','=',$data['salary'])->first();
        $dept=Department::whereNull('deleted_at')->where('dept_id','=',$data['dept'])->first();
        $division=Division::whereNull('deleted_at')->where('id','=',$data['divi_id'])->first();

          return view('employee_details',compact(['data','statedata','distdata','talukadata','citydata','salary','dept','division']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
        $data=Employee::where('hash_id','=',$id)->whereNull('deleted_at')->first();
        // dd($data);
        $state_id=$data['state_id'];
        $statedata=State::whereNull('deleted_at')->get();
        
         $salary=Salary::whereNull('deleted_at')->get();
        $dept=Department::whereNull('deleted_at')->get();
        $division=Division::whereNull('deleted_at')->get();

          return view('edit_employee',compact(['data','statedata','salary','dept','division']));

   
    }

    public function getemp($id)
    {
           
        $empdata=Employee::whereNull('deleted_at')->where("dept",$id)->pluck("middlename","emp_id");
        return json_encode($empdata);    
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $inputArr=$request->all();
        // dd($inputArr);
           $request->validate([
            'firstname' => 'required|min:2',
            'middlename' => 'required|min:1',
            'email'=>'required',
            'Mono'=>'required',
            'Salary' => 'required',
            'age' => 'required|min:1',
            'village_id' => 'required',
            'taluka_id' => 'required',
            'dist_id' => 'required',
            'state_id' => 'required',
            'join_date' => 'required',
            'dob' => 'required',
        ]);
          $dob = Carbon::parse($inputArr['dob'])->format('Y-m-d');
          $join_date = Carbon::parse($inputArr['join_date'])->format('Y-m-d');

        $task =[
            'firstname'=>$inputArr['firstname'],
            'middlename'=>$inputArr['middlename'],
            'email'=>$inputArr['email'],
            'Mono'=>$inputArr['Mono'],
            'salary'=>$inputArr['Salary'],
            'dept'=>$inputArr['dept'],
            'dob'=>$dob,
            'join_date'=>$join_date,
            'age'=>$inputArr['age'],
            'divi_id'=>$inputArr['divi'],
            'dept'=>$inputArr['dept'],
            'village_id'=>$inputArr['village_id'],
            'taluka_id'=>$inputArr['taluka_id'],
            'dist_id'=>$inputArr['dist_id'],
            'state_id' => $inputArr['state_id'],
            
            
        ];

        $emp=Employee::where('hash_id','=',$inputArr['hash_id'])->update($task);
        return redirect(route('emp'))->with('message', 'Record Updated!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model =Employee::where('hash_id','=',$inputArr['id']);
        $userdata=$model->first();
        $id=$userdata['email'];
        $user=User::where('email','=',$id);
        
        $model->delete();
        $user->delete();
        return response()->json($inputArr['id']);
    }
}
