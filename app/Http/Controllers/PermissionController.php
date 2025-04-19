<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Services\PermissionService;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected PermissionService $PermissionService;

    public function __construct(PermissionService $PermissionService)
    {
        $this->PermissionService = $PermissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->PermissionService->getPermissions();
        return self::paginated($permissions,PermissionResource::class,'Permissions Reatrieved successfully',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = $this->PermissionService->storePermission($request->validated());
        return self::success(new PermissionResource($permission),'Permission added Successfully',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $permission = $this->PermissionService->showPermission($permission);
        return self::success(new PermissionResource($permission),'Permission Retrieved Successfully',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission = $this->PermissionService->updatePermission($permission,$request->validated());
        return self::success(new PermissionResource($permission),'Permission updated Successfully',200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return self::success(null,'Permission Deleted Successfully',200);

    }
}
