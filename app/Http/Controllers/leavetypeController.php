<?php

namespace App\Http\Controllers;

use App\Leavetype as Leave;
use Illuminate\Http\Request;

class leavetypeController extends Controller
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
        //
          return view('leave_type');
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
        $hash_id=md5(uniqid(rand(), true));
                //Validate
          $request->validate([
            'leave_type' => 'required|min:2|alpha|unique:leavetype,leave_type',
          
        ]);
        
        $task = Leave::create(['leave_type' => $inputArr['leave_type'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //

        $leave['data']=Leave::whereNull('deleted_at')->get();

        return response()->json($leave);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

        $inputArr=$request->all();
        $editdata['data']=Leave::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
      return response()->json($editdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
                $inputArr=$request->all();

        $edit_id=$inputArr['edit_id'];
        $name=$inputArr['ename'];
                //Validate
                $request->validate([
                    'ename' => 'required|min:2|alpha',
                  
                ]);

        $data=Leave::where('hash_id','=',$edit_id)->update(['leave_type'=>$name]);

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
     * @param  \App\Leave  $leave
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
