<?php

namespace App\Http\Controllers;
use App\State;
use App\Taluka;
use App\District;
use Illuminate\Http\Request;
use DB;
class TalukaController extends Controller
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

        $statedata=State::whereNull('deleted_at')->get();

        return view('taluka',compact('statedata'));
    }

    
    public function getTaluka($id) 
    {        
        $talukadata=Taluka::whereNull('deleted_at')->where("dist_id",$id)->pluck("taluka_name","taluka_id");
        return json_encode($talukadata);
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
               'taluka_name' => 'required|min:2|alpha|unique:talukas,taluka_name',
                  
          ]);

        $task = Taluka::create(['taluka_name'=>$inputArr['taluka_name'],'dist_id'=>$inputArr['dist_name'],'state_id' => $inputArr['state_name'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $talukaData['data']=DB::table('talukas')
                             ->join('states','states.state_id','=','talukas.state_id')
                             ->join('districts','talukas.dist_id','=','districts.dist_id')
                             ->select('talukas.taluka_id','talukas.taluka_name','talukas.hash_id','districts.district_name','states.state_name','talukas.created_at','talukas.updated_at','talukas.deleted_at')
                             ->get();
        // $talukaData['data']=Taluka::whereNull('deleted_at')->get();

        return response()->json($talukaData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
        $inputArr=$request->all();
        $editdata['data']=Taluka::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
      return response()->json($editdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputArr=$request->all();
        $edit_id=$inputArr['edit_id'];
        $state_id=$inputArr['state_name'];
        $dist_id=$inputArr['dist_name'];
        $taluka_name=$inputArr['etaluka_name'];

        $data=Taluka::where('hash_id','=',$edit_id)->update(['dist_id'=>$dist_id,'state_id'=>$state_id,'taluka_name'=>$taluka_name]);

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
     * @param  \App\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inputArr=$request->all();
        $model = Taluka::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
