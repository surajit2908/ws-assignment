<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
    }

    /**
     * user listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $userArr = Admin::where('role_id', '!=', '0')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "User",
            "userArr" => $userArr
        ];

        return view('admin.user.index')->with('dataArr', $dataArr);
    }

    /**
     * user add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userAdd()
    {
        $roleArr = Role::all();
        $dataArr = [
            "page_title" => "Add User",
            "roleArr" => $roleArr
        ];

        return view('admin.user.add_user')->with('dataArr', $dataArr);
    }

    /**
     * user save
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function userInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|unique:admins,email',
            'password' => 'required',
            'role_id' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();

            $input['password'] = bcrypt($input['password']);
            Admin::create($input);

            DB::commit();

            return redirect()->route('admin.user')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "User added successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * user edit page
     * param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userEdit($id)
    {
        $userArr = Admin::find($id);
        $roleArr = Role::all();
        $dataArr = [
            "page_title" => "Edit User",
            "userArr" => $userArr,
            "roleArr" => $roleArr,
        ];

        return view('admin.user.edit_user')->with('dataArr', $dataArr);
    }

    /**
     * user update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|unique:admins,email,' . $id,
            'role_id' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();
            $admin = Admin::find($id);

            if ($input['password'])
                $input['password'] = bcrypt($input['password']);
            else
                $input['password'] = $admin->password;

            Admin::find($id)->update($input);

            DB::commit();

            return redirect()->route('admin.user')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "User updated successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * user delete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function userRemove($id)
    {
        try {
            DB::beginTransaction();
            Admin::find($id)->delete();

            DB::commit();
            return redirect()->route('admin.user')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "User deleted successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
