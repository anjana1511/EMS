<?php

namespace App\Http\Controllers;
use App\Advancepayment;
// use App\Designation;
use App\Managesalary;
use App\Salary;
use App\User;
use App\Employee;
use App\Leavetype;
use App\Empleave;
use DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ManagesalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = Employee::all();
    $users=DB::table('employee')
    ->join('salary','salary.emp_id','=','employee.emp_id')
    ->groupBy('employee.firstname')
    ->get();   
        return view('managesalary.index',compact('users'));
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

    public function store(Request $request)
    {
    //  dd($request->all());

        $users = new Managesalary();
        $users -> emp_id = $request -> emp_id;
        $users -> emp_name = $request -> employee_name;
        $users -> total_leave =$request -> leave_count;
        $users -> leave_pay=$request->leave_pay;
        $users -> tax = $request -> tax;
        $users -> gross_salary = $request -> gross_salary;
        $users -> net_salary=$request->net_salary;
        $users -> advance=$request->advance;
        $users -> total=$request->total;
        $users -> save();
        // $id=$users->id;

        // dd($advance);
        return redirect()->route('salarylist');
    }

    public function generate_slip($id)
    {

        $data = DB::table('manage_salary')
        ->select('manage_salary.*','employee.firstname','employee.middlename','employee.dob',
        'village.village_name','talukas.taluka_name','districts.district_name','states.state_name'
        ,'department.dept_name')
        ->join('employee', function($join) {
            $join->on('employee.emp_id','=', 'manage_salary.emp_id');
        })->where('manage_salary.id','=',$id)
        ->leftJoin('village', function($join){
            $join->on('village.village_id','=','employee.village_id');
        })->leftJoin('talukas', function($join){
            $join->on('talukas.taluka_id','=','employee.taluka_id');
        })->leftJoin('districts', function($join){
            $join->on('districts.dist_id','=','employee.dist_id');
        })->leftJoin('states', function($join){
            $join->on('states.state_id','=','employee.state_id');
        })->leftJoin('department', function($join){
            $join->on('department.dept_id','=','employee.dept');
        })
        ->groupBy('employee.firstname')
        ->get();
        return view('managesalary.generate_slip',compact('data'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // 
        $inputArr=$request->all();
        $id=$inputArr['employee_id'];

        $advance = Advancepayment::where('emp_id','=',$id)->get();
        //advance payment calculation
        if($advance->isEmpty())
        {
            $advancePayment="0";
        }
        else {
            $advancePayment=Advancepayment::where('emp_id',$id)->select(DB::raw("SUM(amount) as total"))->pluck('total')->implode(', ');
        }
        $user=Employee::where('emp_id','=',$id)->get();
        $username=$user->pluck('firstname')->implode(', ');

        $amt =Salary::where('emp_id','=',$id)->get(['gross_salary','tax']);
           
        $net_salary=DB::table('salary')->select(DB::raw("gross_salary-tax as net_salary"))
        ->where('emp_id','=',$id)->pluck('net_salary')->implode(', ');
       

        //To count the leaves of the employee
        $leaves=Empleave::where('emp_id',$id)->where('leave_status',1)->get();
            if($leaves->isEmpty()){
              $total_leaves="0";
            }
            else{
                $fromdate=$leaves->pluck('leave_fromdate')->implode(', ');
                $todate=$leaves->pluck('leave_todate')->implode(', ');
                $diff = strtotime($todate) - strtotime($fromdate);
                $total_leaves=$diff / 86400;
            }
        
         if($total_leaves > '15')
         {
            
             $total=$net_salary-$advancePayment-5000;   
             $leave_pay=5000;
                    
         }
         else
         {
             $total=$net_salary-$advancePayment;
             $leave_pay=0;
            
         }
  

        return view('managesalary.details',compact('leave_pay','id','total','net_salary','amt','username','advance','advancePayment','total_leaves'));
    }
    public function salarylistfun()
    {
       $salaryData['data'] = DB::table('employee')
    ->select('employee.firstname','manage_salary.id as s_id','salary.*','advance_payment.amount',DB::raw("SUM(advance_payment.amount) as total"))
    ->join('salary', function($join) {
        $join->on('salary.emp_id','=', 'employee.emp_id');
    })
    ->leftJoin('advance_payment', function($join) {
        $join->on('advance_payment.emp_id','=', 'employee.emp_id');
      
    })->leftjoin('manage_salary',function($join){
        $join->on('manage_salary.emp_id','=','employee.emp_id');
    })
    ->groupBy('employee.firstname')
    ->get();
     return response()->json($salaryData);

    }
    public function salarylist()
    {

        $salaryData = DB::table('employee')
        ->select('employee.firstname','employee.dob','manage_salary.total_leave','manage_salary.id as s_id','salary.*','advance_payment.amount',DB::raw("SUM(advance_payment.amount) as total"))
        ->join('salary', function($join) {
            $join->on('salary.emp_id','=', 'employee.emp_id');
        })
        ->leftJoin('advance_payment', function($join) {
            $join->on('advance_payment.emp_id','=', 'employee.emp_id');
          
        })->join('manage_salary',function($join){
            $join->on('manage_salary.emp_id','=','employee.emp_id');
        })
        ->groupBy('employee.firstname')
        ->get();
                return view('managesalary.salarylist',compact('salaryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
