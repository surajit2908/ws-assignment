<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function __construct()
    {
    }

    /**
     * role listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $roleArr = Role::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Role",
            "roleArr" => $roleArr
        ];

        return view('admin.role.index')->with('dataArr', $dataArr);
    }

    /**
     * role add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function roleAdd()
    {
        $permissionArr = Permission::all();
        $dataArr = [
            "page_title" => "Add Role",
            "permissionArr" => $permissionArr
        ];

        return view('admin.role.add_role')->with('dataArr', $dataArr);
    }

    /**
     * role save
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function roleInsert(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,role_name'
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();

            $role = Role::create($input);

            if (@$input['permissions']) {
                foreach ($input['permissions'] as $permission) {
                    $permissionData[] = ['role_id' => $role->id, 'permission_id' => $permission, 'created_at' => Now(), 'updated_at' => Now()];
                }

                RolePermission::insert($permissionData);
            }

            DB::commit();

            return redirect()->route('admin.role')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Role added successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * role edit page
     * param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function roleEdit($id)
    {
        $roleArr = Role::find($id);
        $permissionArr = Permission::all();
        $rolePermissionArr = RolePermission::where('role_id', $id)->pluck('permission_id')->toArray();
        $dataArr = [
            "page_title" => "Edit Role",
            "roleArr" => $roleArr,
            "permissionArr" => $permissionArr,
            "rolePermissionArr" => $rolePermissionArr,
        ];

        return view('admin.role.edit_role')->with('dataArr', $dataArr);
    }

    /**
     * role update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function roleUpdate(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,role_name,' . $id,
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();
            Role::find($id)->update($input);

            if (@$input['permissions']) {
                RolePermission::where('role_id', $id)->delete();
                foreach ($input['permissions'] as $permission) {
                    $permissionData[] = ['role_id' => $id, 'permission_id' => $permission, 'created_at' => Now(), 'updated_at' => Now()];
                }

                RolePermission::insert($permissionData);
            }

            DB::commit();

            return redirect()->route('admin.role')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Role updated successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * role delete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function roleRemove($id)
    {
        try {
            DB::beginTransaction();
            Role::find($id)->delete();
            RolePermission::where('role_id', $id)->delete();

            DB::commit();
            return redirect()->route('admin.role')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Role deleted successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
