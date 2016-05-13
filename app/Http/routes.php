<?php

Route::get('/', function() {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

/**
 * Village pages
 */
Route::get('/villages', ['middleware' => ['ability:root,view-villages'], 'uses' => 'HomeController@viewVillages']);
Route::get('/village/{id}', ['middleware' => ['ability:root,view-villages'], 'uses' => 'HomeController@viewVillage']);

/**
 * Admin group
 */
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', ['middleware' => ['ability:root,manage-admin'], 'uses' => 'Admin\AdminController@manageAdmin']);

    /**
     * Roles and Permissions
     */
    //manage roles and permissions
    Route::get('/manage-roles', ['middleware' => ['ability:root,manage-roles'], 'uses' => 'Admin\AdminController@manageRoles']);
    //add roles
    Route::get('/add-role', ['middleware' => ['ability:root,add-roles'], 'uses' => 'Admin\RolesController@addRole']);
    Route::post('/add-role', ['middleware' => ['ability:root,add-roles'], 'uses' => 'Admin\RolesController@addRole']);
    //edit roles
    Route::get('/edit-role/{id}', ['middleware' => ['ability:root,edit-roles'], 'uses' => 'Admin\RolesController@editRole']);
    Route::post('/edit-role/{id}', ['middleware' => ['ability:root,edit-roles'], 'uses' => 'Admin\RolesController@editRole']);
    //delete roles
    Route::get('/delete-role/{id}', ['middleware' => ['ability:root,delete-roles'], 'uses' => 'Admin\RolesController@deleteRole']);
    Route::post('/delete-role/{id}', ['middleware' => ['ability:root,delete-roles'], 'uses' => 'Admin\RolesController@deleteRole']);
    //manage role permissions
    Route::get('/manage-role-permissions/{id}', ['middleware' => ['ability:root,manage-role-permissions'], 'uses' => 'Admin\RolesController@manageRolePermissions']);
    Route::post('/manage-role-permissions/{id}', ['middleware' => ['ability:root,manage-role-permissions'], 'uses' => 'Admin\RolesController@manageRolePermissions']);
    //add role permissions
    Route::get('/add-role-permission/{id}', ['middleware' => ['ability:root,add-role-permissions'], 'uses' => 'Admin\RolesController@addRolePermission']);
    Route::post('/add-role-permission/{id}', ['middleware' => ['ability:root,add-role-permissions'], 'uses' => 'Admin\RolesController@addRolePermission']);
    //delete role permissions
    Route::get('/delete-role-permission/{role_id}/{perm_id}', ['middleware' => ['ability:root,delete-role-permissions'], 'uses' => 'Admin\RolesController@deleteRolePermission']);
    //add permissions
    Route::get('/add-permission', ['middleware' => ['ability:root,add-permissions'], 'uses' => 'Admin\PermissionsController@addPermission']);
    Route::post('/add-permission', ['middleware' => ['ability:root,add-permissions'], 'uses' => 'Admin\PermissionsController@addPermission']);
    //edit permissions
    Route::get('/edit-permission/{id}', ['middleware' => ['ability:root,edit-permissions'], 'uses' => 'Admin\PermissionsController@editPermission']);
    Route::post('/edit-permission/{id}', ['middleware' => ['ability:root,edit-permissions'], 'uses' => 'Admin\PermissionsController@editPermission']);
    //delete permissions
    Route::get('/delete-permission/{id}', ['middleware' => ['ability:root,delete-permissions'], 'uses' => 'Admin\PermissionsController@deletePermission']);
    Route::post('/delete-permission/{id}', ['middleware' => ['ability:root,delete-permissions'], 'uses' => 'Admin\PermissionsController@deletePermission']);

    /**
     * Users
     */
    //manage users
    Route::get('/manage-users', ['middleware' => ['ability:root,manage-users'], 'uses' => 'Admin\AdminController@manageUsers']);
    //add users
    Route::get('/add-user', ['middleware' => ['ability:root,add-users'], 'uses' => 'Admin\UsersController@addUser']);
    Route::post('/add-user', ['middleware' => ['ability:root,add-users'], 'uses' => 'Admin\UsersController@addUser']);
    //edit users
    Route::get('/edit-user/{id}', ['middleware' => ['ability:root,edit-users'], 'uses' => 'Admin\UsersController@editUser']);
    Route::post('/edit-user/{id}', ['middleware' => ['ability:root,edit-users'], 'uses' => 'Admin\UsersController@editUser']);
    //delete users
    Route::get('/delete-user/{id}', ['middleware' => ['ability:root,delete-users'], 'uses' => 'Admin\UsersController@deleteUser']);
    Route::post('/delete-user/{id}', ['middleware' => ['ability:root,delete-users'], 'uses' => 'Admin\UsersController@deleteUser']);
    //manage user roles
    Route::get('/manage-user-roles/{id}', ['middleware' => ['ability:root,manage-user-roles'], 'uses' => 'Admin\UsersController@manageUserRoles']);
    Route::post('/manage-user-roles/{id}', ['middleware' => ['ability:root,manage-user-roles'], 'uses' => 'Admin\UsersController@manageUserRoles']);
    //add user roles
    Route::get('/add-user-role/{id}', ['middleware' => ['ability:root,add-user-roles'], 'uses' => 'Admin\UsersController@addUserRole']);
    Route::post('/add-user-role/{id}', ['middleware' => ['ability:root,add-user-roles'], 'uses' => 'Admin\UsersController@addUserRole']);
    //delete user roles
    Route::get('/delete-user-role/{user_id}/{role_id}', ['middleware' => ['ability:root,delete-user-roles'], 'uses' => 'Admin\UsersController@deleteUserRole']);
});

Route::get('/execute', 'ExecuteController@index');