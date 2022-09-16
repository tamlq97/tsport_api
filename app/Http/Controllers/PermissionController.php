<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Http\Resources\Permission\PermissionCollection;
use App\Http\Resources\Permission\Permission as PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return PermissionCollection|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection|PermissionCollection
    {
        if (Gate::denies('access_permission')) {
            return abort(401);
        }
        if ($request->showData) {
            return Permission::all();
        }
        $columns = ['id', 'name'];
        $dir = $request->dir;
        $length = $request->length;
        $column = $request->column;
        $query = Permission::orderBy($columns[$column], $dir);
        $search = $request->search;
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($length);
        return new PermissionCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionStoreRequest $request
     * @return Response|PermissionResource
     */

    public function store(PermissionStoreRequest $request): Response|PermissionResource
    {
        if (Gate::denies('create_permission')) {
            return abort(401);
        }
        $permission = Permission::create(['name' => $request->name]);
        return new PermissionResource($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return Response|PermissionResource
     */
    public function show(Permission $permission): Response|PermissionResource
    {
        if (Gate::denies('view_permission')) {
            return abort(401);
        }
        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest $request
     * @param Permission $permission
     * @return Response|PermissionResource
     */
    public function update(PermissionUpdateRequest $request, Permission $permission): Response|PermissionResource
    {
        if (Gate::denies('edit_permission')) {
            return abort(401);
        }
        $permission->update(['name' => $request->name]);
        return new PermissionResource($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse
    {
        if (Gate::denies('delete_permission')) {
            return abort(401);
        }
        $permission->delete();
        return response()->json(["message" => "Successfully delete role."]);
    }
}
