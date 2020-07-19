<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Base\Models\Permission;
use App\Base\Models\Role;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->authorize('have-access', 'roles.index');
        $roles = Role::latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('have-access', 'roles.create');
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('have-access', 'roles.create');
       $request->validate([
            'name'        => 'required|max:30|unique:roles,name',
            'slug'        => 'required|unique:roles,slug',
            'description' => 'max:500|min:3',
            'full-access' => 'required|in:yes,not',
        ]);

        $role = Role::create($request->all());

        if ($request->input('permissions')) {
            $role->permissions()->sync($request->input('permissions'));
        }

        return redirect()->route('roles.index')->with('status', __('Role saved successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('have-access', 'roles.show');
        $permissionsRole = [];

        foreach ($role->permissions as $permission) {
            $permissionsRole[] = $permission->id;
        }

        $permissions = Permission::get();
        return view('roles.show', compact('role', 'permissions', 'permissionsRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('have-access', 'roles.edit');
        $permissionsRole = [];

        foreach ($role->permissions as $permission) {
            $permissionsRole[] = $permission->id;
        }

        $permissions = Permission::get();
        return view('roles.edit', compact('role', 'permissions', 'permissionsRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('have-access', 'roles.edit');
        $request->validate([
             'name'        => 'required|max:30|unique:roles,name,'.$role->id,
             'slug'        => 'required|unique:roles,slug,'.$role->id,
             'description' => 'max:500|min:3',
             'full-access' => 'required|in:yes,not',
         ]);

         $role->update($request->all());

         if ($request->input('permissions')) {
             $role->permissions()->sync($request->input('permissions'));
         } else {
             $role->permissions()->sync([]);
         }

         return redirect()->route('roles.index')->with('status', __('Role updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('have-access', 'roles.destroy');
        $role->delete();
        return redirect()->route('roles.index')->with('status', __('Role deleted successfully'));
    }
}
