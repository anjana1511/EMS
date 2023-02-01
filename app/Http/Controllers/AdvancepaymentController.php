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
use Illuminate\Http\Request;

class AdvancepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emp = Employee::whereNull('deleted_at')->get();
        return view('managesalary.advancepayment',compact(['emp']));

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
        // dd($request->all());
        $salaries = new Advancepayment();
        $salaries -> emp_id = $request -> emp_id;
        $salaries -> date = $request -> pdate;
        $salaries -> amount = $request -> amount;
        $salaries -> save();
        
        return redirect()->back()->with('message', 'Record Inserted!');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advancepayment $advancepayment)
    {
        //
        $paymentData['data'] = DB::table('advance_payment')
                               ->select('advance_payment.*','employee.firstname')
                               ->join('employee','employee.emp_id','=','advance_payment.emp_id')
                               ->whereNull('advance_payment.deleted_at')->get();
            return response()->json($paymentData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $inputArr=$request->all();
        $editdata['data']=Advancepayment::where('id','=',$inputArr['edit_id'])->first();
      return response()->json($editdata);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $inputArr=$request->all();
        $edit_id=$inputArr['edit_id'];
        $amount=$inputArr['eamount'];
        $date=$inputArr['edate'];
        $emp_id=$inputArr['emp_id'];
                //Validate
                $request->validate([
                    'eamount' => 'required|min:2',
                    'emp_id' => 'required'
                  
                ]);

        $data=Advancepayment::where('id','=',$edit_id)->update(['amount'=>$amount,'date'=>$date,'emp_id'=>$emp_id]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();

        $model = Advancepayment::where('id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
