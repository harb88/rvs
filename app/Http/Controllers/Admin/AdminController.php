<?php

namespace rvs\Http\Controllers\Admin;

use rvs\Http\Controllers\Controller;
use rvs\Http\Requests;
use Illuminate\Http\Request;

use rvs\Models\User;
use rvs\Models\Role;
use rvs\Models\Permission;

class AdminController extends Controller
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
     * @return \Illuminate\Http\Response
     */

    public function manageAdmin()
    {
        return view('admin.manage-admin');
    }

    /**
     * Manage roles view action
     * /admin/manage-roles
     * @return mixed
     */
    public function manageRoles()
    {
        //get ordered list of roles
        $roles = Role::orderBy('name')->get();

        //get ordered list of permissions
        $permissions = Permission::orderBy('name')->get();

        //display view
        return view('admin.manage-roles')->with(['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Manage users view action
     * /admin/manage-users
     * @return mixed
     */
    public function manageUsers()
    {
        //get ordered list of users
        $users = User::orderBy('name')->get();

        //display view
        return view('admin.manage-users')->with(['users' => $users]);
    }
}
