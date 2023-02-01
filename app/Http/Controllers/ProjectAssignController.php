<?php

namespace App\Http\Controllers;

use App\ProjectAssign;
use App\Project;
use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use DB;
use App\Role;
use Auth;
use User;


class ProjectAssignController extends Controller
{
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
          
          return view('project_assign',compact('deptdata','role'));
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
        //   $request->validate([
        //     'pname' => 'required|min:2|alpha|unique:projects,pname',
        //     'dept_name' => 'required',
        //     'pdetails' => 'required'
          
        // ]);
        
        $task = ProjectAssign::create(['dept_id' => $inputArr['dept_name'],'hash_id'=>$hash_id,'p_id' =>$inputArr['pname'],'emp_id' =>$inputArr['ename']]);
        return redirect()->back()->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectAssign  $projectAssign
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $pdata['data']= DB::table('project_assign')
           ->join('employee','employee.emp_id','=','project_assign.emp_id')
           ->join('projects','projects.p_id','=','project_assign.p_id')
           ->join('department', 'department.dept_id', '=', 'project_assign.dept_id')
           ->select('project_assign.hash_id','employee.firstname','employee.middlename','employee.emp_id as emp','department.dept_id','department.dept_name','projects.pname','projects.p_id')
           ->whereNull('employee.deleted_at')
           ->whereNull('department.deleted_at')
           ->whereNull('project_assign.deleted_at')
           ->get();

        return response()->json($pdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectAssign  $projectAssign
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectAssign $projectAssign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectAssign  $projectAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectAssign $projectAssign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectAssign  $projectAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        // dd($inputArr['id']);
        $model = ProjectAssign::where('hash_id','=',$inputArr['id']);
       
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
