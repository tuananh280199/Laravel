<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    private $permission;

    function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    function index()
    {
        $permissions = $this->permission->latest()->simplePaginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    function create()
    {
        return view('admin.permission.create');
    }

    function createSubmit(Request $request)
    {
        try {
            DB::beginTransaction();
            //insert module parent
            $permission = $this->permission->create([
                'name' => $request->module_parent,
                'display_name' => $request->module_parent,
                'parent_id' => 0,
                'key_code' => $request->module_parent
            ]);
            //insert permission of module parent
            foreach ($request->module_children as $value) {
                $this->permission->create([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $permission->id,
                    'key_code' => $value . '_' . $request->module_parent
                ]);
            }
            DB::commit();
            return redirect()->route('permissions.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }
}
