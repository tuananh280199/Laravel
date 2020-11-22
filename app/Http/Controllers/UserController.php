<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use DeleteItemModelTrait;
    private $user;
    private $role;

    function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    function index(Request $request)
    {
        $users = $this->user->latest()->simplePaginate(10);
        if ($request->name) $users = $this->user->where('name', 'like', '%' . $request->name . '%')->latest()->simplePaginate(10);
        return view('admin.user.index', compact('users'));
    }

    function create()
    {
        $roles = $this->role->all(); //lấy role để hiển thị
        return view('admin.user.create', compact('roles'));
    }

    function createSubmit(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $user = $this->user->create($data);
            $user->roles()->attach($request->role_id); //cách thêm dùng eloquent relationship
            // foreach ($roleIds as $roleId) {
            //     DB::table('role_user')->insert([
            //         'role_id' => $roleId,
            //         'user_id' => $user->id
            //     ]);
            // }
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $roleOfUser = $user->roles; //lấy roles của user 
        // dd($roleOfUser);
        return view('admin.user.edit', compact('roles', 'user', 'roleOfUser'));
    }

    function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $this->user->find($id)->update($data); //update trả về true/false
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id); //sync : thêm những tag chưa có vào, có rồi ko thêm
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->user);
    }
}
