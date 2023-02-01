<?php

namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $division = Division::whereNull('deleted_at')->paginate(2);

        // return view('division', compact('division'));
        return view('Manage_roles');
        //
    	// $dev_permission = Permission::where('slug','create-tasks')->first();
		// //Add Admin role
		// $dev_role = new Role();
		// $dev_role->slug = 'Creator';
		// $dev_role->role_name = 'Creator';
		// $dev_role->save();//roles
		// //attach admin permission
		// $per=$dev_role->permissions()->attach($dev_permission);  //roles_permission  1 per_id


        		//Permission for admin
		// $createTasks = new Permission();
		// $createTasks->slug = 'All';
		// $createTasks->per_name = 'All';
		// $createTasks->save(); //permissions
		// //attach role
		// $createTasks->roles()->attach($dev_role);  // roles_permissions 16 per_id 19 role_id 


        // $developer = new User();
		// $developer->name = 'Damini';
		// $developer->email = 'damini@gmail.com';
		// $developer->password = bcrypt('123456789');
		// $developer->save(); //users
		// $developer->roles()->attach($dev_role);  //roles_permission  //Creator
		// $developer->permissions()->attach($dev_permission);  //roles_per...  //Create Task

        // return response()->json($per);
        // return view('division', compact('division'));
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
       // $hash_id= $hash_id=md5(uniqid(rand(), true));
    //    print_r($inputArr);exit;
        //Validate
        //   $request->validate([
        //     'name' => 'required|min:2|alpha|unique:roles,role_name',
          
        // ]);
        
				// //Add Admin role
		// $dev_role = new Role();
		// $dev_role->slug = 'Creator';
		// $dev_role->role_name = 'Creator';
		// $dev_role->save();//roles

        $task = Role::create(['role_name' => $inputArr['role_name'],'slug'=> $inputArr['rslug']]);
        return redirect()->back()->with('message', 'Record Inserted!');
    }

}
