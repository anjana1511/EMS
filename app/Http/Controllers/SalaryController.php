<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use App\Employee;
use DB;
use App\Leavetype;
use App\Empleave;
use App\Advancepayment;
class SalaryController extends Controller
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

        $emp = Employee::whereNull('deleted_at')->get();
         $data = Salary::whereNull('deleted_at')->paginate(2);

   
        return view('managesalary.salary', compact('data','emp'));
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
        //     'amount' => 'required',
        //     'emp_id' => 'required'
          
        // ]);
        
        $task = Salary::create(['gross_salary' => $inputArr['amount'],'tax' => $inputArr['tax'],'emp_id' => $inputArr['emp_id'],'hash_id'=>$hash_id]);
        
        return redirect()->back()->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
        
       $salaryData['data'] = DB::table('employee')
    ->select('employee.firstname','salary.*','advance_payment.amount',DB::raw("SUM(advance_payment.amount) as total"))
    ->join('salary', function($join) {
        $join->on('salary.emp_id','=', 'employee.emp_id');
    })
    ->leftJoin('advance_payment', function($join) {
        $join->on('advance_payment.emp_id','=', 'employee.emp_id');
      
    })
    ->groupBy('employee.firstname')
    ->get();
        return response()->json($salaryData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $editdata['data']=Salary::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
      return response()->json($editdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
                 $inputArr=$request->all();
                //  dd($inputArr);

        $edit_id=$inputArr['edit_id'];
        $amount=$inputArr['eamount'];
        $tax=$inputArr['etax'];
        $emp_id=$inputArr['emp_id'];
                //Validate
                $request->validate([
                    'eamount' => 'required|min:2',
                    'emp_id' => 'required'
                  
                ]);

        $data=Salary::where('hash_id','=',$edit_id)->update(['gross_salary'=>$amount,'tax'=>$tax,'emp_id'=>$emp_id]);

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
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();

        $model = Salary::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
