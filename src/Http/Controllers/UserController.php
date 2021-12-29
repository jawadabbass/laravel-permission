<?php

namespace Jawadabbass\LaravelPermissionUuid\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jawadabbass\LaravelPermissionUuid\Http\Requests\UserFormRequest;
use Jawadabbass\LaravelPermissionUuid\Models\RoleUser;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('View Users');

        return view('jawad_permission_uuid::user.index');
    }

    public function fetchUsersAjax(Request $request)
    {
        hasPermission('View Users');

        $users = User::select('*')->where('user_type', '!=', 'super_admin')->withoutGlobalScopes();
        return Datatables::of($users)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && !empty($request->name)) {
                    $query->where('users.name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('email') && !empty($request->email)) {
                    $query->where('users.email', 'like', "%{$request->get('email')}%");
                }
            })
            ->addColumn('name', function ($users) {
                return Str::limit($users->name, 50, '...');
            })
            ->addColumn('email', function ($users) {
                return Str::limit($users->email, 50, '...');
            })
            ->addColumn('action', function ($users) {
                $editUser = $deleteUser = '';
                if(isAllowed('Edit User')){
                    $editUser = '<a href="' . route(config('jawad_permission_uuid.route_name_prefix').'users.edit', [$users->id]) . '" class="btn btn-warning m-1" title="Edit details">
                     Edit
                </a>';
                }
                if(isAllowed('Delete User')){
                    $deleteUser = '<a href="javascript:void(0);" onclick="deleteUser(\'' . $users->id . '\');" class="btn btn-danger m-1" title="Delete">
                     Delete
                </a>';
                }
                return $editUser.$deleteUser;
            })
            ->rawColumns(['action','name','email'])
            ->orderColumns(['name','email'], ':column $1')
            ->setRowId(function ($users) {
                return 'usersDtRow' . $users->id;
            })
            ->make(true);
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('Add New User');

        $user = new User();
        return view('jawad_permission_uuid::user.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        hasPermission('Add New User');

        $user = new User();
        $user = $this->setUserValues($request, $user);
        $user->save();

        $this->setUserRoles($request, $user);
        /*         * ************************************ */
        flash('User has been added!', 'success');
        return Redirect::route(config('jawad_permission_uuid.route_name_prefix').'users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        hasPermission('Edit User');

        return view('jawad_permission_uuid::user.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        hasPermission('Edit User');

        $user = $this->setUserValues($request, $user);
        $user->save();

        $this->setUserRoles($request, $user);
        /*         * ************************************ */
        flash('User has been updated!', 'success');
        return Redirect::route(config('jawad_permission_uuid.route_name_prefix').'users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        hasPermission('Delete User');

        $user->delete();
        echo 'ok';
    }


    private function setUserValues($request, $user){

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('is_admin', 0);
        if(!empty($request->input('password', ''))){
            $user->password = Hash::make($request->input('password'));
        }

        return $user;
    }

    private function setUserRoles($request, $user){

        $roleIds = $request->role_ids;
        if(count($roleIds) > 0){
            RoleUser::where('user_id', 'like', $user->id)->delete();
            foreach($roleIds as $role_id){
                $userRole = new RoleUser();
                $userRole->id = Str::uuid();
                $userRole->user_id = $user->id;
                $userRole->role_id = $role_id;
                $userRole->save();
            }
        }
    }
}
