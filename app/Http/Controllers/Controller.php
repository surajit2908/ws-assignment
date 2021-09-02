<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use App\Models\Permission;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const GALLERY_PIC_FOLDER = "galler_image";

    /**
     * checking for module permissions
     * @param mixed $moduleName
     * @return bool
     */
    public function checkPermission($moduleName)
    {
        if (Auth::user()->role_id == '0') {
            return true;
        } else {
            $role_permission = Auth::user()->getRolePermission->pluck('permission_id')->toArray();
            $permissions = Permission::whereIn('id', $role_permission)->pluck('module_name')->toArray();

            if (in_array($moduleName, $permissions)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
