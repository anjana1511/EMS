<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
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
        $designation = Designation::whereNull('deleted_at')->paginate(2);

        return view('designation', compact('designation'));
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
        $hash_id= $hash_id=md5(uniqid(rand(), true));

        //Validate
          $request->validate([
            'name' => 'required|min:2|alpha|unique:designation,name',
          
        ]);
        
        $task = Designation::create(['name' => $inputArr['name'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
        $designation['data']=Designation::whereNull('deleted_at')->get();

        return response()->json($designation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $editdata['data']=Designation::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
       return response()->json($editdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        //
        $inputArr=$request->all();

        $edit_id=$inputArr['edit_id'];
        $name=$inputArr['ename'];
                //Validate
                $request->validate([
                    'ename' => 'required|min:2|alpha',
                  
                ]);

        $data=Designation::where('hash_id','=',$edit_id)->update(['name'=>$name]);

        if($data)
        {
            return redirect()->back()->with('message', 'Record Updated!');
        }
        else
        {
            return redirect()->back()->with('error', 'Record Not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();

        $model = Designation::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
