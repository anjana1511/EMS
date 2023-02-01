<?php
namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{   

	public function __construct()
    {
        $this->middleware('auth');
    }
        public function index()
         {

			$roles=Role::whereNull('deleted_at')->get();
			$per=Permission::whereNull('deleted_at')->get();
			$users=User::whereNull('deleted_at')->get();

			$currentPath= Route::getFacadeRoot()->current()->uri();
			if($currentPath == "permission")
			{

			return view('Manage_roles',compact('per','roles','users'));
			}
			else {
				return view('assign_roles',compact('per','roles','users'));
			}

         }
		 public function getdata()
		 {
			$perdata['data']=DB::table('roles_permissions')
			->join('permissions','permissions.id','=','roles_permissions.permission_id')
			->join('roles','roles.id','=','roles_permissions.role_id')
			->join('users','users.id','=','roles_permissions.user_id')
			->select('roles.role_name','permissions.per_name','users.name','roles_permissions.*')
			->get();
		   return response()->json($perdata);
		 }
		 public function store(Request $request)
		 {
			$inputArr=$request->all();
		
			switch ($request->input('action')) {
				case 'add_role':
					$task = Role::create(['role_name' => $inputArr['role_name'],'slug'=> $inputArr['rslug']]);
					return redirect()->back()->with('message', 'Record Inserted!');
					break;
		
				case 'add_per':
					$task = Permission::create(['per_name' => $inputArr['per_name'],'slug'=> $inputArr['slug']]);
					return redirect()->back()->with('message', 'Record Inserted!');
					
					break;
		
				case 'assign_per':
						$role_id=$inputArr['role_id'];
						$per_id=$inputArr['per_id'];
						$user_id=$inputArr['user_id'];
    
						$manager = new User();
						 $manager->roles()->attach($role_id, ['permission_id'=> $per_id,'user_id'=>$user_id ]);
						$manager->users()->attach($user_id,['permission_id'=>$per_id,'user_id'=>$user_id]);
						$role=new Role();
						$role->users()->attach($user_id,['role_id'=>$role_id]);

		                return redirect()->back()->with('message', 'Record Inserted!');	

                        break;
				 }

		 }
		 public function destroy(Request $request)
		 {
			$inputArr=$request->all();
			switch ($request->input('action')) {
				case 'del_role':
					            $id=$inputArr['role_id'];
							 Role::where('id',$id)->get()->each(function ($game) {
				 
								 $game->permissions()->detach();
							     $game->users()->detach();
								 $game->delete();
						 
							 });
						break;
			   case 'del_per':
				             $id=$inputArr['per_id'];
     						Permission::where('id',$id)->get()->each(function ($game) {
				 
								 $game->roles()->detach();
								 $game->users()->detach();
								 $game->delete();
						 
							 });
				      break;
		
			}
			return redirect()->back()->with('message', 'Record Deleted!');;
		 }


		 public function destroy_assignrole(Request $request)
		 {
			$inputArr=$request->all();
			  $id=$inputArr['id'];
			$role=new Role();
			$mod=DB::table('users_roles')->where('user_id', '=', $id);
			$mod->delete();

			User::where('id',$id)->get()->each(function ($game) {
				
				$game->roles()->detach();
				$game->users()->detach();
			  
				
				});
				return redirect()->back()->with('message', 'Record Deleted!');;
		 }

}
?>