<?php

namespace rvs\Http\Controllers\Admin;

use rvs\Http\Controllers\Controller;
use rvs\Http\Requests;
use Illuminate\Http\Request;

use rvs\Models\Role;
use rvs\Models\Permission;

class RolesController extends Controller
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
     * Add role view action
     * /admin/add-role
     * @param Request $request
     * @return mixed
     */
    public function addRole(Request $request)
    {
        //check for post
        if($request->isMethod('post'))
        {
            //validate request data
            $this->validate($request, [
                'name' => 'required|max:255',
                'display_name' => 'required|max:255',
                'description' => 'required|max:255'
            ]);

            //add role
            $role = new Role();
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();
            
            //redirect to manage-roles route with success message
            return redirect('admin/manage-roles')->withErrors('!success!Role '.$role->name.' created successfully!');
        }
        else
        {
            //no post - display view
            return view('admin.roles.add-role');
        }
    }

    /**
     * Edit role view action
     * /admin/edit-role/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function editRole(Request $request, $id)
    {
        //find role for $id or goto 404 if no role
        $role = Role::findOrFail($id);

        //check for post
        if($request->isMethod('post'))
        {
            //validate request data
            $this->validate($request, [
                'name' => 'required|max:255',
                'display_name' => 'required|max:255',
                'description' => 'required|max:255'
            ]);

            //update role
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();

            //redirect to manage-roles route with success message
            return redirect('admin/manage-roles')->withErrors('!success!Role '.$role->name.' updated successfully!');
        }
        else
        {
            //no post - display view
            return view('admin.roles.edit-role')->with(['role' => $role]);
        }
    }

    /**
     * Delete role view action
     * /admin/delete-role/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function deleteRole(Request $request, $id)
    {
        //find role for $id or goto 404 if no role
        $role = Role::findOrFail($id);

        //check for post
        if($request->isMethod('post'))
        {
            //delete role
            $role->delete();

            //redirect to manage-roles route with success message
            return redirect('admin/manage-roles')->withErrors('!success!Role '.$role->name.' deleted successfully!');
        }
        else
        {
            //no post - display view
            return view('admin.roles.delete-role')->with(['role' => $role]);
        }
    }

    /**
     * Manage role permissions view action
     * /admin/manage-role-permissions/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function manageRolePermissions(Request $request, $id)
    {
        //find role for $id or goto 404 if no role
        $role = Role::findOrFail($id);

        //get ordered list of role's permissions
        $permissions = $role->perms()->orderBy('name', 'asc')->get();

        //display view
        return view('admin.roles.manage-role-permissions')->with(['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Add role permission view action
     * /admin/add-role-permission/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function addRolePermission(Request $request, $id)
    {
        //find role for $id or goto 404 if no role
        $role = Role::findOrFail($id);


        //get ordered list of role's permissions
        $permissions = Permission::orderBy('name', 'asc')->get();

        //check for post
        if($request->isMethod('post'))
        {
            //check there was a permission selected
            if($request->has('permission'))
            {
                //find permission or goto 404
                $permission = Permission::findOrFail((int)$request->input('permission'));

                //attach permission to role
                $role->attachPermission($permission);

                //redirect to manage-role-permissions route with success message
                return redirect('admin/manage-role-permissions/'.$id)->withErrors('!success!Added '.$permission->name.' to '.$role->name.'!');
            }
            else
            {
                //no permission selected
                //redirect to manage-role-permissions route with error message
                return redirect('admin/manage-role-permissions/'.$id)->withErrors("No permission selected!");
            }
        }
        else
        {
            //display view
            return view('admin.roles.add-role-permission')->with(['role' => $role, 'permissions' => $permissions]);
        }
    }

    /**
     * Delete role permission view action
     * /admin/delete-role-permission/{role_id}/{perm_id}
     * @param $role_id
     * @param $perm_id
     * @return mixed
     */
    public function deleteRolePermission($role_id, $perm_id)
    {
        //find role for $role_id or goto 404 if no role
        $role = Role::findOrFail($role_id);

        //find permission for $perm_id or goto 404 if no permission
        $permission = Permission::find($perm_id);

        //remove permission
        $role->detachPermission($permission);

        //redirect to manage-role-permissions route with success message
        return redirect('admin/manage-role-permissions/'.$role_id)->withErrors("!success!".$permission->name.' removed from '.$role->name);
    }
}
