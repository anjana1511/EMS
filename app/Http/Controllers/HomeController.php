<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Role;
use App\User;
use App\State;
use App\Employee;
use App\Department;
use App\Designation;
use Auth;
use DB;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      $id=Auth::user();

    $role = $id->hasRole('admin');
    
        $roles=Role::where('slug','=','users')->pluck('slug')->toArray();
        
        $users=Role::with('users')->whereIn('slug',$roles)->count();
 
         $roles1=Role::where('slug','=','admin')->pluck('slug')->toArray();

         $emp=Employee::whereNull('deleted_at')->count();
        $dept=Department::whereNull('deleted_at')->count();
        $Designation=Designation::whereNull('deleted_at')->count();

         $admin=Role::with('users')->whereIn('slug',$roles1)->count();

        
        return view('home',compact('users','admin','emp','dept','Designation'));
    }



    public function profile()
    {
        $statedata=State::whereNull('deleted_at')->get();

        return view('profile',compact('statedata'));
        // return view('profile');
    }

    public function update_profile(Request $request)
    {
          
        // $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|min:2|alpha',
        //     'state_id' => 'required|min:1',
        //     'dist_id' => 'required|min:1',
        //     'taluka_id' => 'required|min:1',
        //     'village_id' => 'required|min:1',
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        
        // ]);

        $userdata=User::where('email',$request->email)->first();
        $img=$userdata['image'];
        if(!is_null($request->file('image')))
          {  
            $file = $request->file('image') ;
          
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path('/images/users');

            $new_name = rand() . '.' . $file->getClientOriginalExtension();
        
            $request->file('image')->move($destinationPath, $new_name);

            $form_data = array(
            'image'            =>   $new_name
            );
        }
        else
        {

            $form_data = array(
                'image'            =>   '',
            );
        }
        
        $data=User::where('email','=',$request->email)->update($form_data);

        if($data)
        {
            return redirect()->back()->with('message', 'Record Updated!');
        }
        else
        {
            return redirect()->back()->with('error', 'Error!');
        }

    }
    
}
