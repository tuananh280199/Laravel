<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    use DeleteItemModelTrait;
    private $role;
    private $permission;

    function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    function index(Request $request)
    {
        $roles = $this->role->latest()->simplePaginate(10);
        if ($request->name) $roles = $this->role->where('name', 'like', '%' . $request->name . '%')->latest()->simplePaginate(10);
        return view('admin.role.index', compact('roles'));
    }

    function create()
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get(); //lấy permission cha
        return view('admin.role.create', compact('permissionsParent'));
    }

    function createSubmit(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name
            ];
            $role = $this->role->create($data);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function edit($id)
    {
        $role = $this->role->find($id);
        $permissionsParent = $this->permission->where('parent_id', 0)->get(); //lấy permission cha
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit', compact('permissionsParent', 'role', 'permissionsChecked'));
    }

    function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name
            ];
            $this->role->find($id)->update($data);
            $role = $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->role);
    }
}
