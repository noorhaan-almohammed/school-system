<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected RoleService $RoleService ;

    public function __construct(RoleService $RoleService)
    {
        $this->RoleService = $RoleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->RoleService->getRoles();
        return self::paginated($roles, RoleResource::class, 'Roles retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->RoleService->storeRole($request->validated());
        return self::success(new RoleResource($role),'Role Created Successfully',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
       $role = $this->RoleService->showRole($role);
       return self::success(new RoleResource($role),'Role Retrieved Successfully',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role = $this->RoleService->updateRole($role , $request->validated());
        return self::success(new RoleResource($role),'Role Updated Successfully',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return self::success(null,'Role deleted Successfully',200);
    }

      /**
     * Assign permissions to a role.
     *
     */

     public function givePermissionToRole(Role $role,Permission $permission)
     {
         $role->givePermissionTo($permission);
         return self::success(null, 'Permission added to the role successfully');
     }

       /**
     * Remove a permission from a role.
     *
     */
    public function revokePermissionFromRole(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);
        return self::success(null, 'Permission removed from the role successfully');
    }
}
