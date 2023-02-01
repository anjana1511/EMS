<?php

namespace App\Http\Controllers;

use App\Village;
use App\State;
use App\Disrtict;
use App\Taluka;
use Illuminate\Http\Request;
use DB;
class VillageController extends Controller
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
//        return view('village');
            $statedata=State::whereNull('deleted_at')->get();

            return view('village',compact('statedata'));
        
    }

    
    public function getVillage($id) 
    {        
       
        $villagedata=Village::whereNull('deleted_at')->where("taluka_id",$id)->pluck("village_name","village_id");
        return json_encode($villagedata);
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
            'village_name' => 'required|min:2',
          
        ]);
        $task = Village::create(['village_name'=>$inputArr['village_name'],'taluka_id'=>$inputArr['taluka_name'],'dist_id'=>$inputArr['dist_name'],'state_id' => $inputArr['state_name'],'hash_id'=>$hash_id]);
        return redirect()->back()->with('message', 'Record Inserted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
           $talukaData['data']=DB::table('village')
                             ->join('states','states.state_id','=','village.state_id')
                             ->join('talukas','talukas.taluka_id','=','village.taluka_id')
                             ->join('districts','village.dist_id','=','districts.dist_id')
                             ->select('village.village_id','village.village_name','village.hash_id','districts.district_name','states.state_name','talukas.taluka_name','village.created_at','village.updated_at','village.deleted_at')
                             ->get();
     
        // $talukaData['data']=Village::whereNull('deleted_at')->get();
        return response()->json($talukaData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $inputArr=$request->all();
        $editdata['data']=Village::where('hash_id','=',$inputArr['edit_id'])->whereNull('deleted_at')->first();
         return response()->json($editdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputArr=$request->all();
        $edit_id=$inputArr['edit_id'];
        $state_id=$inputArr['state_id'];
        $dist_id=$inputArr['dist_id'];
        $taluka_id=$inputArr['taluka_id'];
        $village_name=$inputArr['evillage_name'];

        $data=Village::where('hash_id','=',$edit_id)->update(['taluka_id'=>$taluka_id,'dist_id'=>$dist_id,'state_id'=>$state_id,'village_name'=>$village_name]);

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
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        
        $inputArr=$request->all();
        $model = Village::where('hash_id','=',$inputArr['id']);
        
        $model->delete();

        return response()->json($inputArr['id']);
    }
}
