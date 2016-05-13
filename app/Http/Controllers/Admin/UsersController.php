<?php

namespace rvs\Http\Controllers\Admin;

use rvs\Http\Controllers\Controller;
use rvs\Http\Requests;
use Illuminate\Http\Request;

use rvs\Models\User;
use rvs\Models\Role;

class UsersController extends Controller
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
     * Add user view action
     * /admin/add-user
     * @param Request $request
     * @return view
     */
    public function addUser(Request $request)
    {
        //check for post
        if($request->isMethod('post'))
        {
            //validate request data
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8|confirmed'
            ]);

            //add user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            //redirect to manage-users route with success message
            return redirect('admin/manage-users')->withErrors('!success!User '.$user->name.' created successfully!');
        }
        else
        {
            //no post - display view
            return view('admin.users.add-user')->with(['request' => $request]);
        }
    }

    /**
     * Edit user view action
     * /admin/edit-user/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function editUser(Request $request, $id)
    {
        //find user for $id or goto 404 if no user
        $user = User::findOrFail($id);

        //check for post
        if($request->isMethod('post'))
        {
            //validate request data
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            ]);

            //update user
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            //redirect to manage-users route with success message
            return redirect('admin/manage-users')->withErrors(['!success!User '.$user->name.' updated successfully!', "!warning!Please note: If the user's email address was changed they must now use the new email to log in."]);
        }
        else
        {
            //no post - display view
            return view('admin.users.edit-user')->with(['user' => $user]);
        }
    }

    /**
     * Delete user view action
     * /admin/delete-user/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function deleteUser(Request $request, $id)
    {
        //prevent users deleting themselves
        if($request->user()->id == $id)
        {
            //redirect to manage-users route with error message
            return redirect('admin/manage-users')->withErrors('You cannot delete your own account!');
        }

        //find user for $id or goto 404 if no user
        $user = User::findOrFail($id);

        //check for post
        if($request->isMethod('post'))
        {
            //delete user
            $user->delete();

            //redirect to manage-users route with success message
            return redirect('admin/manage-users')->withErrors('!success!User '.$user->name.' deleted successfully!');
        }
        else
        {
            //no post - display view
            return view('admin.users.delete-user')->with(['user' => $user]);
        }
    }

    /**
     * Manage user roles view action
     * /admin/manage-user-roles/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function manageUserRoles(Request $request, $id)
    {
        //find user for $id or goto 404 if no user
        $user = User::findOrFail($id);

        //get ordered list of user's roles
        $roles = $user->roles()->orderBy('name', 'asc')->get();

        //display view
        return view('admin.users.manage-user-roles')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Add user role view action
     * /admin/add-user-role/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function addUserRole(Request $request, $id)
    {
        //find user for $id or goto 404 if no user
        $user = User::findOrFail($id);

        //get ordered list of roles
        $roles = Role::orderBy('name', 'asc')->get();

        //check for post
        if($request->isMethod('post'))
        {
            //check there was a role selected
            if($request->has('role'))
            {
                //find selected role or goto 404 is no role
                $role = Role::findOrFail((int)$request->input('role'));

                //attach role to user
                $user->attachRole($role);

                //redirect to manage-user-roles route with success message
                return redirect('admin/manage-user-roles/'.$id)->withErrors('!success!'.$user->name.' given '.$role->name.' role!');
            }
            else
            {
                //redirect to manage-user-roles route with error message
                return redirect('admin/manage-user-roles/'.$id)->withErrors("No role selected!");
            }
        }
        else
        {
            //no post - display view
            return view('admin.users.add-user-role')->with(['user' => $user, 'roles' => $roles]);
        }
    }

    /**
     * Delete user role view action
     * /admin/delete-user-role/{user_id}/{role_id}
     * @param $user_id
     * @param $role_id
     * @return mixed
     */
    public function deleteUserRole($user_id, $role_id)
    {
        //find user for $user_id or goto 404 if no user
        $user = User::findOrFail($user_id);

        //find role for $role_id or goto 404 if no role
        $role = Role::findOrFail($role_id);

        //remove role from user
        $user->detachRole($role);

        //redirect to manage-user-roles route with success message
        return redirect('admin/manage-user-roles/'.$user_id)->withErrors("!success!".$role->name.' role removed from '.$user->name.'!');
    }
}
